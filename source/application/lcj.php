<?php
/**
* 调试方法
* @param  array   $data  [description]
*/
function p($data,$die=1)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
if ($die) die;
}
/*
 * record 数据数据
 * header 导出的第一行
 *
 */
function excel_export($record,$header,$title=''){

    $keys = array_keys($header);
    $html = "\xEF\xBB\xBF";
    foreach ($header as $li) {
        $html .= $li . "\t ,";
    }
    $html .= "\n";
    $count = count($record);
    $pagesize = ceil($count/5000);
    for ($j = 1; $j <= $pagesize; $j++) {
        $list = array_slice($record, ($j-1) * 5000, 5000);
        if (!empty($list)) {
            $size = ceil(count($list) / 500);
            for ($i = 0; $i < $size; $i++) {
                $buffer = array_slice($list, $i * 500, 500);
                $user = array();
                foreach ($buffer as $row) {
                    foreach ($keys as $key) {
                        $data[] = $row[$key];
                    }
                    $user[] = implode("\t ,", $data) . "\t ,";
                    unset($data);
                }
                $html .= implode("\n", $user) . "\n";
            }
        }
    }

    if(empty($title)){
        $title=date("Ymd");
    }
    ob_clean();
    header("Content-type:text/csv");
    header("Content-Disposition:attachment; filename={$title}.csv");
    echo $html;
    exit();

}

/**
 * 将字符串转换为数组
 *
 * @param    string  $data   字符串
 * @return   array   返回数组格式，如果，data为空，则返回空数组
 */
function string2array($data) {
    if($data == '') return array();
    @eval("\$array = $data;");
    return $array;
}
/**
 * 将数组转换为字符串
 *
 * @param    array   $data       数组
 * @param    bool    $isformdata 如果为0，则不使用new_stripslashes处理，可选参数，默认为1
 * @return   string  返回字符串，如果，data为空，则返回空
 */
function array2string($data, $isformdata = 1) {
    if($data == '') return '';
    if($isformdata) $data = new_stripslashes($data);
    return addslashes(var_export($data, TRUE));
}