<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin bảo hành</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <table id="myTable" class="display table table-striped" style="width:100%">
        <button id="addButton">Thêm mới</button>
        <thead>
            <tr>
                <th hidden>ID</th>
                <th>Tên</th>
                <th>SĐT</th>
                <th>Model</th>
                <th>Giá</th>
                <th>Imei</th>
                <th>Ngày</th>
                <th>Ghi chú</th>
                <th hidden>Hình</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        <tfoot>
            <tr>
                <th hidden>ID</th>
                <th>Tên</th>
                <th>SĐT</th>
                <th>Model</th>
                <th>Giá</th>
                <th>Imei</th>
                <th>Ngày</th>
                <th>Ghi chú</th>
                <th hidden>Hình</th>
            </tr>
        </tfoot>
    </table>

    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close"
            title="Close Modal">&times;</span>
        <form class="modal-content" action="/action_page.php">
            <div class="container">
                <h1>Thông tin tài khoản</h1>
                <!-- <p>Are you sure you want to delete your account?</p> -->

                <p>Tên: <span id="name"></span></p>
                <p>SĐT: <span id="phone"></span></p>
                <p>Model: <span id="model"></span></p>
                <p>Giá: <span id="price"></span></p>
                <p>IMEI: <span id="imei"></span></p>
                <p>Ngày: <span id="date"></span></p>
                <p>Ghi chú: <span id="description"></span></p>
                <img id="thumbnail" src="#" alt="your image" style="display:none; width:200px;height:200px; margin-left: auto; margin-right: auto;">
                <br>

                <div class="clearfix">
                    <button type="button" class="cancelbtn" onclick="document.getElementById('id01').style.display='none'">Hủy</button>
                    <button type="button" class="deletebtn">Xóa</button>
                </div>
            </div>
        </form>
    </div>

    <div id="id02" class="modal">
        <span onclick="document.getElementById('id02').style.display='none'" class="close"
            title="Close Modal">&times;</span>
        <form class="modal-content" id="createForm" action="/action_page.php">
            <div class="container">
                <h1>Thêm mới</h1>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Tên</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">SĐT</label>
                        <input type="text" class="form-control" id="phone-input" pattern="^\d{10,11}$">
                        <div id="phone-error" class="error-message" style="display: none; color: red;">Số điện thoại không hợp lệ</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Model</label>
                        <input type="text" class="form-control" id="model">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Giá</label>
                        <input type="number" class="form-control" id="price">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">IMEI</label>
                        <input type="text" class="form-control" id="imei">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Ngày</label>
                        <input type="date" class="form-control" id="date">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Ghi chú</label>
                        <input type="text" class="form-control" id="description">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Hình ảnh</label>
                        <br>
                        <input type="file" class="form-control-file" id="file" accept="image/*">
                        <img id="image" src="#" alt="your image" style="display:none; width:200px;height:200px;">
                      </div>
                </div>

                <br>

                <div class="clearfix">
                    <button type="button" class="cancelbtn" onclick="document.getElementById('id02').style.display='none'">Hủy</button>
                    <button type="button" class="createbtn">Tạo</button>
                </div>
            </div>
        </form>
    </div>

    <div id="id03" class="modal">
        <span onclick="document.getElementById('id03').style.display='none'" class="close"
            title="Close Modal">&times;</span>
        <form class="modal-content" action="/action_page.php">
            <div class="container">
                <h1>Xác nhận</h1>
                <p>Bạn có chắc muốn xóa thông tin</p>

                <div class="clearfix">
                    <button type="button" class="cancelbtn" onclick="document.getElementById('id03').style.display='none'">Không</button>
                    <button type="button" class="confirmbtn">Có</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let isLoggedIn = localStorage.getItem('isLoggedIn');
        
        async function login() {
            while(!isLoggedIn){
                let email = prompt("Email:");
                let password = prompt("Password:");

                const response = await fetch("https://api.thuongtamduy.com/auth/login", {
                    method: "POST",
                    body: JSON.stringify({ email, password }),
                    headers: {
                        "Content-Type": "application/json",
                    },
                });

                if (response.ok) {
                    isLoggedIn = true;
                    localStorage.setItem('isLoggedIn', true)
                } else {
                    alert("Sai email hoặc mật khẩu!");
                }
            }

            $(document).ready(function () {
                const tableBody = document.querySelector('#myTable tbody');
                var table;
                fetch('https://api.thuongtamduy.com/api/normal/warranties')
                .then(response => response.json())
                .then(res => {
                    res['data'].forEach(item => {
                        const row = tableBody.insertRow();
                        const idCell = row.insertCell();
                        const nameCell = row.insertCell();
                        const phoneCell = row.insertCell();
                        const modelCell = row.insertCell();
                        const priceCell = row.insertCell();
                        const imeiCell = row.insertCell();
                        const dateCell = row.insertCell();
                        const desciptionCell = row.insertCell();
                        const thumbnailCell = row.insertCell();
                        idCell.textContent = item.id;
                        nameCell.textContent = item.name;
                        phoneCell.textContent = item.phone;
                        modelCell.textContent = item.model;
                        priceCell.textContent = item.price;
                        imeiCell.textContent = item.imei;
                        dateCell.textContent = item.date;
                        desciptionCell.textContent = item.description;
                        thumbnailCell.textContent = item.thumbnail;
                        idCell.style.display = 'none';
                        thumbnailCell.style.display = 'none';
                    });

                    table = $('#myTable').DataTable({
                        scrollY: '50vh',
                        scrollX: true,
                        scrollCollapse: true,
                        paging: true,
                        stateSave: true,
                        fixedColumns: true,
                        pagingType: 'numbers',
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        "order": [[0, "desc"]],
                        "columnDefs": [
                            { "orderable": true, "targets": 0 }
                        ],
                        "language": {
                            "lengthMenu": "Hiển thị _MENU_ dòng trên một trang",
                            "zeroRecords": "Không tìm thấy gì - xin lỗi",
                            "info": "Hiển thị trang _PAGE_ của tổng _PAGES_ trang",
                            "infoEmpty": "Không có bản ghi nào",
                            "infoFiltered": "(Bộ lọc của _MAX_ tổng số bản ghi)",
                            "search": "Tìm kiếm:",
                            "paginate": {
                                "first": "Đầu tiên",
                                "last": "Cuối cùng",
                                "next": "Tiếp theo",
                                "previous": "Phía trước"
                            },
                        }
                    });
                }).catch(error => console.error(error));

                $('#myTable tbody').on('click', 'tr', function () {
                    // var data = table.row(this).data();
                    // console.log(data);
                    // document.getElementById('id01').style.display = 'block';
                    var data = table.row(this).data();

                    $('#id').text(data[0])
                    $('#name').text(data[1]);
                    $('#phone').text(data[2]);
                    $('#model').text(data[3]);
                    $('#price').text(data[4]);
                    $('#imei').text(data[5]);
                    $('#date').text(data[6]);
                    $('#description').text(data[7]);
                    $('#thumnail').text(data[8]);

                    const image = document.getElementById('thumbnail');
                    image.style.display = 'block';
                    image.setAttribute('src', data[8]);

                    var id = data[0];
                    $('.confirmbtn').attr('data-id', id);

                    document.getElementById('id01').style.display = 'block';
                });

                $('.deletebtn').click(function() {
                    document.getElementById('id03').style.display = 'block';
                });

                $('.confirmbtn').click(function() {
                    var id = $(this).attr('data-id');
                    fetch(`https://api.thuongtamduy.com/api/normal/warranties/${id}`, {
                        method: 'DELETE',
                    })
                    .then(res => {
                        if(res.ok){
                            alert(res['message'] ? res['message'] : 'Xóa thành công');
                            location.reload();
                        }
                    })
                    .catch(error => {
                        
                    });
                });

                $('.createbtn').click(function() {
                    const form = document.getElementById("createForm");
                    const name = form.elements["name"].value;
                    const phone = form.elements["phone-input"].value;
                    const model = form.elements["model"].value;
                    const price = form.elements["price"].value;
                    const imei = form.elements["imei"].value;
                    const date = form.elements["date"].value;
                    const description = form.elements["description"].value;
                    const imageFile = form.elements["file"].files[0];

                    let data = new FormData();
                    data.append('name', name);
                    data.append('phone', phone);
                    data.append('model', model);
                    data.append('price', price);
                    data.append('imei', imei);
                    data.append('date', date);
                    data.append('description', description);
                    if(imageFile) {
                        data.append('thumbnail', imageFile, imageFile.name);
                    }
                    
                    fetch(`https://api.thuongtamduy.com/api/normal/warranties`, {
                        method: 'POST',
                        body: data,
                    })
                    .then(res => {
                        if(res.ok){
                            alert(res['message'] ? res['message'] : 'Tạo thành công');
                            location.reload();
                        }
                    })
                    .catch(error => {
                        
                    });
                });

                $('#addButton').click(function() {
                    document.getElementById('id02').style.display = 'block';
                });

            });
        }

        login();

        // Get the modal
        var modal = document.getElementById('id01');
        // When the user clicks anywhere outside of the modal, close it
        document.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        var modal2 = document.getElementById('id02');
        document.onclick = function (event) {
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }

        var modal3 = document.getElementById('id03');
        document.onclick = function (event) {
            if (event.target == modal3) {
                modal3.style.display = "none";
            }
        }


        //Valdate phone number
        const phoneInput = document.getElementById('phone-input');
        const phoneError = document.getElementById('phone-error');

        phoneInput.addEventListener('blur', (event) => {
            const phoneRegex = /^\d{10}$/;
            const phoneValue = event.target.value;
            const isValid = phoneRegex.test(phoneValue);
            if (isValid) {
                event.target.classList.remove('invalid');
                phoneError.style.display = 'none';
            } else {
                event.target.classList.add('invalid');
                phoneError.style.display = 'block';
            }
        });

        //Upload image
        const fileInput = document.getElementById('file');
        const image = document.getElementById('image');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                image.style.display = 'block';
                image.setAttribute('src', this.result);
            });

            reader.readAsDataURL(file);
        });
    </script>

    <style>
        * {box-sizing: border-box}

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
        }

        /* Set a style for all buttons */
        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        button:hover {
            opacity:1;
        }

        /* Float cancel and delete buttons and add an equal width */
        .cancelbtn, .deletebtn, .createbtn, .confirmbtn {
            float: left;
            width: 50%;
        }

        /* Add a color to the cancel button */
        .cancelbtn {
            background-color: #ccc;
            color: black;
        }

        /* Add a color to the delete button */
        .deletebtn, .confirmbtn {
            background-color: #f44336;
        }

        .createbtn {
            background-color: #04AA6D;
        }

        /* Add padding and center-align text to the container */
        .container {
            padding: 16px;
            text-align: center;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: #474e5d;
            padding-top: 50px;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* Style the horizontal ruler */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* The Modal Close Button (x) */
        .close {
            position: absolute;
            right: 35px;
            top: 15px;
            font-size: 40px;
            font-weight: bold;
            color: #f1f1f1;
        }

        .close:hover,
        .close:focus {
            color: #f44336;
            cursor: pointer;
        }

        /* Clear floats */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        input.invalid {
            border-color: red;
        }

        /* Change styles for cancel button and delete button on extra small screens */
        @media screen and (max-width: 400px) {
            .cancelbtn, .deletebtn, .createbtn, .confirmbtn {
                width: 100%;
            }
            .mobile {
                display: none;
            }
            table td:nth-child(6),
            table td:nth-child(5),
            table td:nth-child(8),
            table th:nth-child(6),
            table th:nth-child(5),
            table th:nth-child(8) {
                display: none;
            }
        }
    </style>
</body>

</html>
