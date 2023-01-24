<!-- 
    測試帳號/密碼 : 
    1. admin@admin.com / password
    2. mary@gmail.com / passwordmary
 
    問題點 : 
    1. login_verify 與 register_verify 相同,javascript modules 可能需要思考
    2. logout.js 適用於 index.php 以外的檔案,因檔案路不同,index.php裡自己在寫相同程式,需要思考如何調整

    Bug : 
    1. Chart.js 於 4.0.0 版本後有做了一些特殊改動的樣子，當放大時會慢慢以縮放的方式放大，但如果使用 4.0.0 以下，也就是 3.9.0 的版本就不會有這些問題，但會少了些新增的功能

    https://cdnjs.com/libraries/Chart.js/3.9.1


    ** 蝦皮 與 momo 網站都是只有內容更新，上面設定不更新 => 是不是使用 ajax ?

    ** phpmyadmin 需要再加一欄位 => 年份
-->