<!-- 
    測試帳號/密碼 : 
    1. admin@admin.com / password
    2. mary@gmail.com / passwordmary
    3. test987654@gmail.com / test987654
 
    問題點 : 
    1. login_verify 與 register_verify 相同,javascript modules 可能需要思考
    2. 如果需要做 countdown timer ( 註冊帳戶與重置密碼時輸入電子郵件驗證碼 ),必須考慮到重傳驗證碼的問題
    3. 註冊帳戶時驗證電子郵件的程式 - verifyEmail.php, 可以沿用，但問題是如何導向至 login.php( 因為這個檔案有重置密碼時的相關檔案在使用 )
    => 解法 : url 傳參數 ( 分兩個不同參數, 做兩種不同事情 )

    Bug : 
    1. Chart.js 於 4.0.0 版本後有做了一些特殊改動的樣子，當放大時會慢慢以縮放的方式放大，但如果使用 4.0.0 以下，也就是 3.9.0 的版本就不會有這些問題，但會少了些新增的功能

    https://cdnjs.com/libraries/Chart.js/3.9.1


    ** PHPMailer 的解法 => https://stackoverflow.com/questions/72113637/how-to-use-phpmailer-after-30-may-2022-when-less-secure-app-is-no-longer-an-o

    ** 應用程式密碼 : https://ithelp.ithome.com.tw/articles/10254488

    ** register user account -> send email -> redirect verifyEmail.php -> input verification code -> redirect login.php (register success)
-->