// Lấy thẻ div hiển thị thời gian hiện tại
var currentTimeElement = document.getElementById("current-time");

// Hàm hiển thị thời gian hiện tại
function showCurrentTime() {
    // Lấy thời gian hiện tại
    var currentTime = new Date();

    // Định dạng thời gian theo dạng "Thứ, Ngày Tháng Năm"
    var options = { weekday: 'long', day: 'numeric', month: 'numeric', year: 'numeric' };
    var formattedTime = currentTime.toLocaleDateString('vi-VN', options);

    // Hiển thị thời gian hiện tại
    currentTimeElement.textContent = formattedTime;
}

// Gọi hàm hiển thị thời gian hiện tại
showCurrentTime();


