<!-- Helpers -->
<script src="/template/assets/vendor/js/helpers.js"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="/template/assets/js/config.js"></script>
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="/template/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/template/assets/vendor/libs/popper/popper.js"></script>
<script src="/template/assets/vendor/js/bootstrap.js"></script>
<script src="/template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="/template/assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="/template/assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="/template/assets/js/main.js"></script>

<!-- Page JS -->
<script src="/template/assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script>
    function myFunction() {
        if(!confirm("Bạn có chắc chắn muốn xóa ?"))
        event.preventDefault();
    }
</script>

<script>
    function sendRequest() {
        if(!confirm("Bạn có chắc chắn muốn gửi yêu cầu này ?"))
        event.preventDefault();
    }
</script>

<script>
    function confirmAction() {
        if(!confirm("Bạn có chắc chắn muốn thực hiện hành động này ?"))
        event.preventDefault();
    }
</script>

<script>
    const menuItems = document.querySelectorAll('#menuItem');
    let activeMenuItemIndex = localStorage.getItem('activeMenuItemIndex');

    if (activeMenuItemIndex !== null) {
        menuItems[activeMenuItemIndex].classList.add('active');
    }

    menuItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            // Xóa class active của menu item trước đó (nếu có)
            const currentActiveItem = document.querySelector('#menuItem.active');
            if (currentActiveItem) {
                currentActiveItem.classList.remove('active');
            }
            // Thêm class active vào menu item được click
            item.classList.add('active');

            // Lưu trạng thái của menu item được chọn vào local storage
            localStorage.setItem('activeMenuItemIndex', index);
        });
    });
</script>
