<?php
function passport_key($txt, $encrypt_key) {
    $encrypt_key = md5($encrypt_key);
    $ctr = 0;
    $tmp = '';
    for($i = 0; $i < strlen($txt); $i++) {
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
    }
    return $tmp;
}
//加密
function passport_encrypt($txt/*加密内容*/, $key/*秘钥*/) {
    srand((double)microtime() * 1000000);
    $encrypt_key = md5(rand(0, 32000));
    $ctr = 0;
    $tmp = '';

    for($i = 0;$i < strlen($txt); $i++) {
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        $tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
}
return base64_encode(passport_key($tmp, $key));
}
//解密
function passport_decrypt($txt/*解密内容*/, $key/*秘钥*/) {
    $txt = passport_key(base64_decode($txt), $key);
    $tmp = '';

    for($i = 0;$i < strlen($txt); $i++) {
        $md5 = $txt[$i];
        $tmp .= $txt[++$i] ^ $md5;
}
    return $tmp;
}