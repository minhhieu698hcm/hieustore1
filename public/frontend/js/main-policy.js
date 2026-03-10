// Lấy phần tử policy-nav
const policyNav = document.getElementById('policy-nav');

// Kiểm tra nếu policy-nav tồn tại
if (policyNav) {
    policyNav.addEventListener('click', function(event) {
        // Kiểm tra nếu mục được nhấn là thẻ <a>
        if (event.target.tagName === 'A') {
            event.preventDefault();

            // Ẩn tất cả các mục có class .policy-section
            document.querySelectorAll('.policy-section').forEach(section => {
                section.style.display = 'none';
            });

            // Lấy giá trị của thuộc tính data-target từ thẻ <a> được nhấn
            const targetId = event.target.getAttribute('data-target');

            // Hiển thị mục tương ứng với ID hoặc hiển thị tất cả các mục nếu nhấn vào 'show-all'
            if (targetId) {
                document.getElementById(targetId).style.display = 'block';
            } else if (event.target.id === 'show-all') {
                showAllSections(); // Gọi hàm để hiển thị tất cả các mục
            }
        }
    });
}

// Hàm để hiển thị tất cả các mục khi cần
function showAllSections() {
    document.querySelectorAll('.policy-section').forEach(section => {
        section.style.display = 'block';
    });
}
