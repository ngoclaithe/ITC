// Dữ liệu trong bảng lichkhaigiang
let lichkhaigiang = [];

// Dữ liệu trong bảng monhoc
let monhoc = [];

// Dữ liệu trong bảng lopmonhoc
let lopmonhoc = [];

window.addEventListener("DOMContentLoaded", () => {
  fetchDataFromServer();
});

const fetchDataFromServer = () => {
  // Gửi yêu cầu ajax để lấy dữ liệu từ server
  $.ajax({
    url: "../getDataLichKhaiGiang.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      // Gán dữ liệu từ server vào các biến
      lichkhaigiang = data.lichkhaigiang;
      monhoc = data.monhoc;
      lopmonhoc = data.lopmonhoc;

      // Console.log dữ liệu sau khi gán
      console.log("lichkhaigiang:", lichkhaigiang);
      console.log("monhoc:", monhoc);
      console.log("lopmonhoc:", lopmonhoc);
      renderSelectOptionsAdd();
      renderSelectOptionsEdit();
      // Gọi hàm để hiển thị dữ liệu lên giao diện
      fakeDbFc(monhoc);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data from server:", error);
    },
  });
};
  
  let idEdit = null;
  
  window.addEventListener("DOMContentLoaded", () => {
    renderSelectOptionsAdd();
    renderSelectOptionsEdit();
    fakeDbFc(monhoc);
  });
  
  const fakeDbFc = (value = []) => {
    let bodyId = document.querySelector("#body");
    let txt = "";
    value?.map((i) => {
      let matchLich = lichkhaigiang.find(
        (it) => it?.IDLich?.toString() === i?.IDLich?.toString()
      );
      txt += `<tr>
                  <td>${i?.TenMonHoc}</td>
                  <td>${i?.ThongTinMonHoc}</td>
                  <td>${matchLich?.TenMon}</td>
                  <td>
                      <a onClick="handleEdit(${i?.IDMonHoc})" href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
                              data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                      <a onClick="handleDelete(${i?.IDMonHoc})" href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons"
                              data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
              </tr>`;
    });
    bodyId.innerHTML = txt;
  };
  const formatDate = (date) => {
    const year = date.getFullYear();
    const month = ("0" + (date.getMonth() + 1)).slice(-2);
    const day = ("0" + date.getDate()).slice(-2);
  
    return `${year}-${month}-${day}`;
  };
  
  const renderSelectOptionsAdd = () => {
    const selectElement = document.getElementById("selectIDLichAdd");
    lichkhaigiang.forEach((item) => {
      const option = document.createElement("option");
      option.value = item.IDLich;
      option.textContent = `${item.TenMon} - ${item.NgayBatDau}`;
      selectElement.appendChild(option);
    });
  };
  const renderSelectOptionsEdit = () => {
    const selectElement = document.getElementById("selectIDLichEdit");
    lichkhaigiang.forEach((item) => {
    const option = document.createElement("option");
    option.value = item.IDLich;
    option.textContent = `${item.TenMon} - ${item.NgayBatDau}`;
    selectElement.appendChild(option);
    });
  };
  
  const handleChange = (event) => {
    console.log(event.target.value);
  };
  
  const handleSubmitAdd = (event) => {
    event.preventDefault();
    const formData = new FormData(event.target);
  
    const TenMonHoc = formData.get("TenMonHoc");
    const ThongTinMonHoc = formData.get("ThongTinMonHoc");
    const IDLich = formData.get("IDLich");
  
    const formDataAdd = new FormData();
    formDataAdd.append("TenMonHoc", TenMonHoc);
    formDataAdd.append("ThongTinMonHoc", ThongTinMonHoc);
    formDataAdd.append("IDLich", IDLich);
  
    $.ajax({
        url: "actionAddMonHoc.php",
        type: "POST",
        data: formDataAdd,
        processData: false,
        contentType: false,
        success: function (response) {
            // Xử lý kết quả từ server nếu cần
            fetchDataFromServer(); // Cập nhật dữ liệu từ server
            $("#addEmployeeModal").modal("hide");
        },
        error: function (xhr, status, error) {
            console.error("Error adding new monhoc:", error);
        },
    });
};
const handleSubmitEdit = (event) => {
    event.preventDefault();
    const formData = new FormData(event.target);
  
    const TenMonHoc = formData.get("TenMonHoc");
    const ThongTinMonHoc = formData.get("ThongTinMonHoc");
    const IDLich = formData.get("IDLich");
  
    const formDataEdit = new FormData();
    formDataEdit.append("IDMonHoc", idEdit); // ID của mục cần chỉnh sửa
    formDataEdit.append("TenMonHoc", TenMonHoc);
    formDataEdit.append("ThongTinMonHoc", ThongTinMonHoc);
    formDataEdit.append("IDLich", IDLich);
  
    $.ajax({
        url: "actionEditMonHoc.php",
        type: "POST",
        data: formDataEdit,
        processData: false,
        contentType: false,
        success: function (response) {
            // Xử lý kết quả từ server nếu cần
            fetchDataFromServer(); // Cập nhật dữ liệu từ server
            $("#editEmployeeModal").modal("hide");
        },
        error: function (xhr, status, error) {
            console.error("Error editing monhoc:", error);
        },
    });
};
  
  const handleEdit = (id) => {
    idEdit = id;
    const itemToEdit = monhoc.find((item) => item.IDMonHoc === id);
  
    const subjectInput = document.querySelector(
      '#editEmployeeModal input[name="TenMonHoc"]'
    );
    const ThongTinMonHoc = document.querySelector(
      '#editEmployeeModal input[name="ThongTinMonHoc"]'
    );
    const IDLichSelect = document.getElementById("selectIDLichEdit");
  
    if (itemToEdit) {
      subjectInput.value = itemToEdit.TenMonHoc;
      ThongTinMonHoc.value = itemToEdit.ThongTinMonHoc;
      IDLichSelect.value = itemToEdit.IDLich;
    }
  };
  
  const handleDelete = (id) => {
    idEdit = id;
};

document.getElementById("deleteForm").addEventListener("submit", function (event) {
    event.preventDefault();

    $.ajax({
        url: "actionDeleteMonHoc.php",
        type: "POST",
        dataType: "json",
        data: { IDMonHoc: idEdit },
        success: function (response) {
            // Xử lý thành công, có thể cập nhật giao diện nếu cần
            console.log("Xóa dữ liệu thành công");
            // Sau khi xóa thành công, có thể cần làm mới dữ liệu từ server và cập nhật giao diện
            fetchDataFromServer();
        },
        error: function (xhr, status, error) {
            console.error("Error deleting data:", error);
        },
    });

    $("#deleteEmployeeModal").modal("hide");
    idEdit = null;
});

  
