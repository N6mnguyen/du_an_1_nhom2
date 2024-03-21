<div class="containerfull">
  <div class="bgbanner">Quên mật khẩu</div>
</div>
<div class="container">
  <div class="boxleft mr2pt menutrai">
    <h2>DÀNH CHO BẠN</h2><br><br>

    <a href="index.php">Thoát</a>
  </div>
  <div class="boxright">
    <div class="containerfull mr30">
      <h1>Quên mật khẩu</h1><br>

      <form action="index.php?pg=quenmk" onsubmit="return send()" method="post">
        <div class="row">
          <div class="col-25">
            Email
            <input style="margin-top: 20px;"  type="text" id="email" class="inputt" name="email" placeholder="Nhập email!">
            <h3 class="email-error rr" style="color: red; font-size:medium;"> </h3>
          </div>
        </div>
        <div class="row">
          <div >
            <input style="margin-right: 20px;" type="submit" class="dksm" value="Gửi" name="guiemail">
          </div>
        </div>
      </form>
      <h3 class="thongbao">
      </h3>
    </div>
  </div>
</div>
<script>
  function send() {
    let count = 0;
    var email = document.getElementById("email").value;
    if (email === "") {
        document.querySelector("h3.email-error").textContent = "Vui lòng nhập trường này!!";
        count++;
    } else if (!isValidEmail(email)) {
        document.querySelector("h3.email-error").textContent = "Email không đúng định dạng!";
        count++;
    } else {
        document.querySelector("h3.email-error").textContent = "";
    }
    if (count > 0) {
        return false;
    }
}
</script>