<?php
/*
 *   PHP 終端機顯示聖誕樹
 *   (1) 可自訂層數
 *   (2) 可自訂燈出現機率(機率)
 *   (3) 燈位置以及顏色隨機顯示
 *
 *   使用變數
 *   $layer 層數
 *   $light_probability 燈出現的機率
*/
fwrite(STDOUT, "請輸入想要自訂的層數：");
$layer = trim(fgets(STDIN));

//驗證層數是否為正整數
if (is_numeric($layer) && $layer >= 1) {
    fwrite(STDOUT, "請輸入想要自訂的燈出現的機率(範圍：0 ~ 10)：");
    $light_probability = trim(fgets(STDIN));

    //驗證燈出現的機率是否為整數
    if (is_numeric($light_probability) && $light_probability >= 0) {
        if ($light_probability >= 0 && $light_probability <= 10) {
            show_xmastree($layer, $light_probability); //依照輸入層數以及燈出現的機率來顯示聖誕樹
            echo "設定值{ 層數：$layer, 燈出現的機率：($light_probability/10)}";
        }
        if ($light_probability > 10) {
            echo "\033[31m輸入的{ 燈出現的機率 }超出範圍\033[0m";
        }
    } else {
        echo "\033[31m輸入的{ 燈出現的機率 }非整數\033[0m";
    }
} else {
    echo "\033[31m輸入的{ 層數 }非正整數\033[0m";
}

//顯示聖誕樹
function show_xmastree($layer, $light_probability)
{
    for ($i = 1; $i <= $layer; $i++) {
        show_blank($i, $layer);
        //依照機率顯示是否為燈泡或是樹枝
        for ($j = 0; $j < $i * 2 - 1; $j++) {
            $light = array_fill(0, $light_probability, 1);
            $branch = array_fill($light_probability, 10, 0);
            $arr = array_merge($light, $branch);
            $number = mt_rand(0, 9);
            if ($arr[$number] == '1') {
                random_color();
            } else {
                echo "\033[32m*\033[0m";
            }
        }
        echo "\n";
    }
    show_branch($layer);
}


//隨機顯示燈泡顏色
function random_color()
{
    $color = array(
        "\033[31mo\033[0m",
        "\033[96mo\033[0m",
        "\033[34mo\033[0m",
        "\033[36mo\033[0m",
        "\033[90mo\033[0m",
        "\033[93mo\033[0m",
        "\033[97mo\033[0m"
    );
    $rand_keys = array_rand($color, 1);
    print $color[$rand_keys];
}

// 顯示空白格
function show_blank($i, $layer)
{
    for ($j = $i; $j <= $layer; $j++) {
        echo " ";
    }
}

//顯示樹幹
function show_branch($layer)
{
    for ($z = 1; $z < $layer; $z++) {
        echo " ";
    }
    echo "mWm\n";
}
