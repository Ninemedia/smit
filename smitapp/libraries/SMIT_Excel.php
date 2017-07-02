<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . "/libraries/phpexcel/PHPExcel.php";
// use this library if you want to export thousands of rows with lightweight engine - means very FAST!!!
require_once APPPATH . 'libraries/xlsxwriter.class.php';

/**
 * PHPExcel class.
 *
 * @class SMIT_Excel
 * @author Iqbal
 */
class SMIT_Excel extends PHPExcel
{
	var $CI;
	var $qualified;
	
	// simple export
	var $companyName;
	var $simpleExcel;
	var $objPHPExcel;
	var $objReader;
	var $objWriter;
	var $worksheet;
	var $tempFile;
	var $title;
	var $subTitle;
	var $heading;
	var $exportDate;
	var $data;
	
	/**
	 * All styles settings
	 * @author	Iqbal
	 */
	var $styleBorderThin = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
			),
		),
	);
	
	var $styleOutsideBorderThick = array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THICK,
			),
		),
	);

	/**
	 * Constructor - Sets up the object properties.
	 */
	function __construct()
	{
		$this->CI =& get_instance();
		$this->companyName = COMPANY_NAME;
	}
	
	/**
	 * Simple exporter
	 * @author	Iqbal
	 * ---------------------------------------------------------------------- simple export begins
	 */
	function setHeader($content_type, $filename) {		
		ob_end_clean();
		
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: ' . $content_type);
		header('Content-Disposition: attachment;filename="' . $filename . '"');
	}
	
	/**
	 * Set file properties
	 * 
	 */
	function setFileProperties() {
		// Set document properties
        $this->objPHPExcel->getProperties()
            ->setCreator($this->companyName)
            ->setLastModifiedBy($this->companyName)
            ->setTitle($this->title)
            ->setSubject($this->title)
            ->setDescription($this->title)
            ->setKeywords($this->title)
            ->setCategory($this->title);
	}
	
	/**
	 * Init simple exporter
	 * 
	 */
	function simpleInit() {
		$this->simpleExcel = new XLSXWriter();
		
		$currentTime = time();
		$this->exportDate = date('d M, Y', $currentTime);
		$this->tempFile = 'smitassets/backend/export/' . str_replace(' ', '_', $this->title) . '_' . date('YmdHis', $currentTime) . '.xlsx'; // relative to index.php of CI
		
		// set table header
		if ( is_array( $this->heading[0] ) ) {
			$_heading = array_reverse( $this->heading );
			foreach( $_heading as $heading ) {
				array_unshift( $this->data, $heading );
			}
		} else {
			array_unshift( $this->data, $this->heading );
		}
		// set export date
		array_unshift($this->data, array('Tanggal Export: ' . $this->exportDate));
		// set subtitle
		array_unshift($this->data, array($this->subTitle));
		// set main title
        array_unshift($this->data, array($this->title . ' - ' . $this->companyName));
		
		// start writing data to worksheet
		$this->simpleExcel->writeSheet($this->data, substr( $this->title, 0, 31 ));
		// save as temporaryfile - raw excel - without any styling
        $this->simpleExcel->writeToFile($this->tempFile);
		
		// load file using PHP excel then modif the style
		$this->objReader = new PHPExcel_Reader_Excel2007();
		$this->objPHPExcel = $this->objReader->load( $this->tempFile );
		
		// setup properties
		$this->setFileProperties();
		
		$this->objPHPExcel->setActiveSheetIndex(0);
		$this->worksheet = $this->objPHPExcel->getActiveSheet();
	}
	
	/**
	 * Output simple exporter to file
	 * 
	 */
	function simpleOutput($save=true) {
		$this->objWriter = new PHPExcel_Writer_Excel2007($this->objPHPExcel);
        $this->objWriter->setPreCalculateFormulas(false);
		
		$filename = str_replace(' ', '_', $this->title) . date('YmdHis') . '.xlsx';
		
		if (!$save) {
			$this->setHeader('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', $filename);
			$this->objWriter->save('php://output');
		} else {
			$this->objWriter->save($this->tempFile);
		}
		
		// clean up objects
		$this->objPHPExcel->disconnectWorksheets();
		unset($this->objPHPExcel);

		return base_url( $this->tempFile );
	}
    
    /*
	|--------------------------------------------------------------------------
	| Excel To Array
	|--------------------------------------------------------------------------
	| Helper function to convert excel sheet to key value array
	| Input: path to excel file, set wether excel first row are headers
	| Dependencies: PHPExcel.php include needed
	*/
	function excelToArray($filePath, $header=true, $reformat_header=true){
        //Create excel reader after determining the file type
        $inputFileName  = $filePath;
        /**  Identify the type of $inputFileName  **/
        $inputFileType  = PHPExcel_IOFactory::identify($inputFileName);
        /**  Create a new Reader of the type that has been identified  **/
        $objReader      = PHPExcel_IOFactory::createReader($inputFileType);
        /** Set read type to read cell data onl **/
        $objReader->setReadDataOnly(true);
        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel    = $objReader->load($inputFileName);
        //Get worksheet and built array with first row as header
        $objWorksheet   = $objPHPExcel->getActiveSheet();

        //excel with first row header, use header as key
        if($header){
            $highestRow     = $objWorksheet->getHighestRow();
            $highestColumn  = $objWorksheet->getHighestColumn();
            $headingsArray  = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
            $headingsArray  = $headingsArray[1];

            $r = -1;
            $namedDataArray = array();
            for ($row = 2; $row <= $highestRow; ++$row) {
                $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
                if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                    ++$r;
                    foreach($headingsArray as $columnKey => $columnHeading) {
                		if ($reformat_header)
                    		$columnHeading = strtolower(str_replace(' ', '_', $columnHeading));
                        $namedDataArray[$r][$columnHeading] = empty($dataRow[$row][$columnKey]) ? '' : $dataRow[$row][$columnKey];
                    }
                }
            }
        }
        else{
            //excel sheet with no header
            $namedDataArray = $objWorksheet->toArray(null,true,true,true);
        }

        return $namedDataArray;
	}
	
	/**
	 * Export Score Step 1
	 */
	function simpleExportScoreStep1($data=array()) {
		// setup necessary information
		$this->title 	= 'Laporan Penilaian Tahap 1';
		$this->heading 	= array( 'No', 'Penilai/Juri', 'Kriteria Penilaian', 'Total Nilai' );
		$this->data		= array();
		
		// set data
		$no=1; $total=0;
		foreach($data as $row) {
			if ($no==1) $this->subTitle = date('d M, Y', strtotime($row->datecreated)); // since the export data is datecreated DESC
			
			$this->data[] = array(
				$no++ . '.',
				strtoupper($row->name),
                $row->rate_total,
                $row->comment
			);
		}
		
		// add 3 new rows
		$this->data[] = array();
		$this->data[] = array();
		$this->data[] = array();
		
		// complete subtitle
		$this->subTitle = 'Tanggal Penilaian : ' . date('d M, Y', strtotime($row->datecreated)) . ' s/d ' . $this->subTitle;
		
		// init simple export
		$this->simpleInit();
		
		$rowNumber = count($this->data);
		
		// write formula
		$this->worksheet->setCellValue('B' . $rowNumber, '=SUM(B5:B' . ($rowNumber-1) . ')');
		$this->worksheet->setCellValue('C' . $rowNumber, '=SUM(C5:C' . ($rowNumber-1) . ')');
		$this->worksheet->setCellValue('D' . $rowNumber, '=SUM(D5:D' . ($rowNumber-1) . ')');
		
		// styling excel file
		$this->worksheet->getStyle('A4:D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->worksheet->getStyle('A5:A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->worksheet->getStyle('C5:C' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->worksheet->getStyle('C5:C' . $rowNumber)->getNumberFormat()->setFormatCode('#,##0');
		$this->worksheet->getStyle('D5:D' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->worksheet->getStyle('A4:D' . $rowNumber)->applyFromArray($this->styleBorderThin);
		
		$this->worksheet->getColumnDimension('A')->setWidth(5);
		$this->worksheet->getColumnDimension('B')->setWidth(35);
		$this->worksheet->getColumnDimension('C')->setWidth(20);
		$this->worksheet->getColumnDimension('D')->setWidth(20);
		
		// output to user browser
		return $this->simpleOutput();
	}
	
	// ---------------------------------------------------------------------------
	
	private function _render_pdf( $renderer = 'mpdf' ) {
		$rendererName = '';
		$rendererLibrary = $renderer;
		
		switch( $renderer ) {
			case 'dompdf':
				set_time_limit( 0 );
				ini_set( 'memory_limit', '512M' );
				$rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
				break;
			case 'mpdf':
				set_time_limit( 0 );
				ini_set( 'memory_limit', '512M' );
				$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
				$rendererLibrary = 'mpdf-6.0.0';
				break;
			case 'tcpdf':
				$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
				break;
		}
		
		$rendererLibraryPath = APPPATH . 'libraries/' . $rendererLibrary;
		PHPExcel_Settings::setPdfRenderer( $rendererName, $rendererLibraryPath );
		$this->objWriter = PHPExcel_IOFactory::createWriter( $this->objPHPExcel, 'PDF' );
        $this->objWriter->setSheetIndex(0);
	}

	// ---------------------------------------------------------------------------
}

/*
CHANGELOG
---------
Insert new changelog at the top of the list.
-----------------------------------------------
Version	YYYY/MM/DD  Person Name		Description
-----------------------------------------------
1.0.0   2017/07/01  Iqbal           - Created this changelog
*/