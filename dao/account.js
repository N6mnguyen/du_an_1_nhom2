function sendADD() {
    let count = 0;

    var name = document.getElementById("name").value;
    if (name === "") {
        document.querySelector("h3.name-error").textContent = "Vui lòng nhập tên sản phẩm!";
        count++;
    } else {
        document.querySelector("h3.name-error").textContent = "";
    }

    var dm = document.getElementById("iddm").value;
    if (dm === "") {
        document.querySelector("h3.dm-error").textContent = "Vui lòng chọn danh mục!";
        count++;
    } else {
        document.querySelector("h3.dm-error").textContent = "";
    }

    var mota = document.getElementById("mota").value;
    if (mota === "") {
        document.querySelector("h3.mota-error").textContent = "Vui lòng nhập mô tả sản phẩm!";
        count++;
    } else {
        document.querySelector("h3.mota-error").textContent = "";
    }
    
    var gia = document.getElementById("price").value;
    if (gia === "") {
        document.querySelector("h3.gia-error").textContent = "Vui lòng nhập giá!";
        count++;
    } else {
        document.querySelector("h3.gia-error").textContent = "";
    }
    if (count > 0) {
        return false;
    }
}
// var inputt = document.querySelectorAll(".inputt");
// inputt.forEach(function(inputIndex) {
//     inputIndex.addEventListener("input", function() {
//         if(inputIndex.value == "") {
//             inputIndex.nextElementSibling.innerHTML = "Vui long nhap truong nay";
//         } else {
//             inputIndex.nextElementSibling.innerHTML = "";
//         }
//     })
// })