<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Excel_Model {


    protected  function column_str($key) {
        $array = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
            'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ',
            'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ',
            'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ',
            'EA', 'EB', 'EC', 'ED', 'EE', 'EF', 'EG', 'EH', 'EI', 'EJ', 'EK', 'EL', 'EM', 'EN', 'EO', 'EP', 'EQ', 'ER', 'ES', 'ET', 'EU', 'EV', 'EW', 'EX', 'EY', 'EZ'
        );
        return $array[$key];
    }

    protected  function column($key, $columnnum = 1) {
        return $this->column_str($key) . $columnnum;
    }

    /**
     * 导出Excel
     * @param type $list
     * @param type $params
     */
    function export($list, $params = array()) {

        if (PHP_SAPI == 'cli') {
            die('This example should only be run from a Web Browser');
        }
        require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
        $data = m('common')->getSysset('shop');
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator(empty($data['name'])?'自动售货机':$data['name'])->setLastModifiedBy(empty($data['name'])?'自动售货机':$data['name'])->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("report file");
        $sheet = $excel->setActiveSheetIndex(0);

        //行数
        $rownum = 1;
        //标题
        foreach ($params['columns'] as $key => $column) {
            $sheet->setCellValue($this->column($key, $rownum), $column['title']);
            if (!empty($column['width'])) {
                $sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
            }
        }
        $rownum++;
        //数据
        $len = count($params['columns']);;
        foreach ($list as $row) {

            for ($i = 0; $i < $len; $i++) {
                $value = isset($row[$params['columns'][$i]['field']])?$row[$params['columns'][$i]['field']]:'';
                $sheet->setCellValue($this->column($i, $rownum), $value);
            }
            $rownum++;
        }
        $excel->getActiveSheet()->setTitle($params['title']);
        $filename = urlencode($params['title'] . '-' . date('Y-m-d H:i', time()));
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="' .$filename . '.xlsx"');
        // header('Cache-Control: max-age=0');
        // $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        // $writer->save('php://output');
        //2003格式
        ob_end_clean();
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment;filename="' .$filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $this->SaveViaTempFile($writer);
//        $writer->save('php://output');
        exit;
    }

    /**
     * @author MaoMao
     * @param $list
     * @param array $columns
     * @param string $title
     * @param string $path
     * @param string $appName
     * @return array
     * @throws null
     */
    public  function exportCSV($list, $columns = array(), $path = '',$page = 1,$exflag = false)
    {
        set_time_limit(0);
        if (empty($path) && PHP_SAPI == 'cli') {
            throw new Exception('Excel::exportCSV  should only be run from a Web Browser');
        }
        if(!is_dir($path)) {
            @mkdir($path, 0777);
        }
        //保存地址
        $filename = date('Ymd', time());
        if(!empty($columns['title'])){
            $filename = ($columns['title']) . '-' .$filename.'.csv';
        }
        $savepath = $path.$filename;


        if($page ==1) {
            $tableheader = array();
            foreach ($columns['columns'] as $col) {
                $tableheader[] = $col['title'];
            }
            $tableheader_str = '"' . implode('","', $tableheader) . '"' . "\n";
            $html = iconv('UTF-8', 'GBK//TRANSLIT', $tableheader_str);
        }
        foreach ($list as $value) {
            foreach ($columns['columns'] as $col) {
                $type = '';
                if (isset($col['type']) && $col['type'] === 'string'){
                    $type = "\t";
                }
                $html .= '"'.iconv('UTF-8','GBK//TRANSLIT',$value[$col['field']])."{$type}\",";
            }
            $html .= "\n";
        }

        if($exflag){
            $file = $savepath;
            if(file_exists($file)){
                header("Content-type:application/octet-stream");
                $filename = basename($file);
                header("Content-Disposition:attachment;filename = ".$filename);
                header("Accept-ranges:bytes");
                header("Accept-length:".filesize($file));
                readfile($file);
                file_delete($file);
                exit();
            }else{
                echo "<script>alert('文件不存在')</script>";
            }
        }
        if(!empty($html)){
            file_put_contents($savepath,$html,8);
        }
        return true;
    }

    /**
     * @param $objWriter PHPExcel_Writer_IWriter
     */
    function SaveViaTempFile($objWriter){
       
        $filePath = VENDING_MACHINE_DATA . '/' . $_W['uniacid'] . '/' . rand(0, getrandmax()) . rand(0, getrandmax()) . ".tmp";
        $objWriter->save($filePath);
        readfile($filePath);
        unlink($filePath);
    }

    /**
     * 生成模板文件Excel
     * @param type $list
     * @param type $params
     */
    function temp($title, $columns = array()) {

        if (PHP_SAPI == 'cli') {
            die('This example should only be run from a Web Browser');
        }
        require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';

        $excel = new PHPExcel();
        $excel->getProperties()->setCreator("自动售货机")->setLastModifiedBy("自动售货机")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("report file");
        $sheet = $excel->setActiveSheetIndex(0);
        //行数
        $rownum = 1;

        foreach ($columns as $key => $column) {
            $sheet->setCellValue($this->column($key, $rownum), $column['title']);
            if (!empty($column['width'])) {
                $sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
            }
        }
        $rownum++;
        //数据
        $len = count($columns);;
        for ($k=1;$k<=5000;$k++) {
            for ($i = 0; $i < $len; $i++) {
                $sheet->setCellValue($this->column($i, $rownum), "");
            }
            $rownum++;
        }
        $excel->getActiveSheet()->setTitle($title);
        $filename = urlencode($title);
        //2003格式
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment;filename="' .$filename . '.xls"');
        header('Cache-Control: max-age=0');
        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $writer->save('php://output');
        exit;
    }

    public function  import($excefile){

        global $_W;
        require_once  IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
        require_once  IA_ROOT . '/framework/library/phpexcel/PHPExcel/IOFactory.php';
        require_once  IA_ROOT . '/framework/library/phpexcel/PHPExcel/Reader/Excel5.php';

        $path  = IA_ROOT."/addons/vending_machine/data/tmp/";
        if(!is_dir($path)){
            load()->func('file');
            mkdirs($path,'0777');
        }

        $filename = $_FILES[$excefile]['name'];
        $tmpname = $_FILES[$excefile]['tmp_name'];
        if(empty($tmpname)){
            message('请选择要上传的Excel文件!','','error');
        }
        $ext =  strtolower( pathinfo($filename, PATHINFO_EXTENSION) );
        if($ext!='xlsx' && $ext!='xls'){
            message('请上传 xls 或 xlsx 格式的Excel文件!','','error');
        }

        $file = time().$_W['uniacid'].".".$ext;
        $uploadfile = $path.$file;

        $result  = move_uploaded_file($tmpname,$uploadfile);
        if(!$result){
            message('上传Excel 文件失败, 请重新上传!','','error');
        }

        $reader = PHPExcel_IOFactory::createReader($ext=='xls'?'Excel5':'Excel2007');//use excel2007 for 2007 format

        $excel = $reader->load($uploadfile);
        $sheet = $excel->getActiveSheet();
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnCount= PHPExcel_Cell::columnIndexFromString($highestColumn);
        $values = array();
        for ($row = 1;$row <= $highestRow;$row++)
        {
            $rowValue = array();
            //注意highestColumnIndex的列数索引从0开始
            for ($col = 0;$col < $highestColumnCount;$col++)
            {
                $rowValue[] = (string)$sheet->getCellByColumnAndRow($col, $row)->getValue();

            }
            $values[] = $rowValue;
        }

        return $values;
    }



}
