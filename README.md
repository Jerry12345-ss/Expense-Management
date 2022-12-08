<!-- 
    1. admin@admin.com / password
    2. mary@gmail.com / passwordmary

< 原先Log out >

nav .nav-wrapper .nav-username {
  padding: 0.25rem 2.5rem;
}

nav .nav-wrapper .nav-username i {
  font-size: 25px;
}

nav .nav-wrapper .nav-username .username-logout {
  display: none;
  right: 20%;
  top: 100%;
  --bs-dropdown-link-hover-bg:rgb(111, 188, 191);
  --bs-dropdown-link-active-color: white;
  --bs-dropdown-link-active-bg:rgb(111, 188, 191);
}

nav .nav-wrapper .nav-username .username-logout li:hover a{
  color: white;
}

nav .nav-wrapper .nav-username .username-logout.show{
  display: block;
}

nav .nav-wrapper .nav-username .dropdown-toggle::after {
  display: none;
}

-->


<!-- 
    1. login_verify 與 register_verify 相同,javascript modules 可能需要思考
    2. logout.js 適用於 index.php 以外的檔案,因檔案路不同,index.php裡自己在寫相同程式,需要思考如何調整
-->