<!-- 
    測試帳號/密碼 : 
    1. admin@admin.com / password
    2. mary@gmail.com / passwordmary
    3. test987654@gmail.com / test987654
 
    問題點 : 
    1. login_verify 與 register_verify 相同,javascript modules 可能需要思考

    Bug : 
    1. Chart.js 於 4.0.0 版本後有做了一些特殊改動的樣子，當放大時會慢慢以縮放的方式放大，但如果使用 4.0.0 以下，也就是 3.9.0 的版本就不會有這些問題，但會少了些新增的功能

    https://cdnjs.com/libraries/Chart.js/3.9.1


    ** 蝦皮 與 momo 網站都是只有內容更新，上面設定不更新 => 是不是使用 ajax ?
    ** 忘記密碼的設計可以參考 adidas 的設計 => https://www.adidas.com.tw/login

    ** PHPMailer 的解法 => https://stackoverflow.com/questions/72113637/how-to-use-phpmailer-after-30-may-2022-when-less-secure-app-is-no-longer-an-o

    ** 應用程式密碼 : https://ithelp.ithome.com.tw/articles/10254488

    ** insert data to database / 10 minutes expire -> input verified code page -> reset user password 
-->