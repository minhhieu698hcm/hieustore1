document.getElementById('policy-nav').addEventListener('click', function(event) {
    if (event.target.tagName === 'A') {
        event.preventDefault();

        // Ẩn tất cả các mục
        document.querySelectorAll('.policy-section').forEach(section => {
            section.style.display = 'none';
        });

        // Hiển thị mục được chọn
        const targetId = event.target.getAttribute('data-target');

        if (targetId) {
            document.getElementById(targetId).style.display = 'block';
        } else if (event.target.id === 'show-all') {
            showAllSections(); // Gọi hàm để hiển thị tất cả các mục
        }
    }
});

// Hàm để hiển thị tất cả các mục khi cần
function showAllSections() {
    document.querySelectorAll('.policy-section').forEach(section => {
        section.style.display = 'block';
    });
}
