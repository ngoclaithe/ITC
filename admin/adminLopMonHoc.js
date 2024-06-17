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
      lopmonhoc = data.lopmonhoc.map(function (lopmonhoc) { 
        const monhocRe  = monhoc.filter(function(monhoc){
           return lopmonhoc.IDMonHoc === monhoc.IDMonHoc;
        })[0];
        return {...lopmonhoc, ...monhocRe};
      } );
      // Console.log dữ liệu sau khi gán
      console.log("lichkhaigiang:", lichkhaigiang);
      console.log("monhoc:", monhoc);
      console.log("lopmonhoc:", lopmonhoc);
      renderSelectOptionsAdd();
      renderSelectOptionsEdit();
      // Gọi hàm để hiển thị dữ liệu lên giao diện
      fakeDbFc(lopmonhoc);
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
    fakeDbFc(lopmonhoc);
  });
  
  const fakeDbFc = (value = []) => {
    let bodyId = document.querySelector("#body");
    let txt = "";
    value?.map((i) => {
        console.log(i);
      txt += `<tr>
                  <td>${i?.MaLop}</td>
                  <td>${new Date(i?.ThoiGianBatDau).toLocaleDateString()}</td>
                  <td>${new Date(i?.ThoiGianKetThuc).toLocaleDateString()}</td>
                  <td>${new Date(i?.NgayKhaiGiang).toLocaleDateString()}</td>
                  <td>${i?.TenMonHoc}</td>
                  <td>${i?.DiaDiemHoc}</td>
                  <td>${i?.SoLuongHocVien}</td>
                  <td>
                      <a onClick="handleEdit('${i?.MaLop}')" href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
                              data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                      <a onClick="handleDelete('${i?.MaLop}')" href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons"
                              data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
              </tr>`;
    });
    bodyId.innerHTML = txt;
  };
  
  const renderSelectOptionsAdd = () => {
    const selectElement = document.getElementById("selectIDLichAdd");
    monhoc.forEach((item) => {
      const option = document.createElement("option");
      option.value = item.IDMonHoc;
      option.textContent = `${item.IDMonHoc} - ${item.TenMonHoc}`;
      selectElement.appendChild(option);
    });
  };
  const renderSelectOptionsEdit = () => {
    const selectElement = document.getElementById("selectIDLichEdit");
    monhoc.forEach((item) => {
      const option = document.createElement("option");
      option.value = item.IDMonHoc;
      option.textContent = `${item.IDMonHoc} - ${item.TenMonHoc}`;
      selectElement.appendChild(option);
    });
  };
  
  const handleChange = (event) => {
    console.log(event.target.value);
  };
  
const handleSubmitAdd = (event) => {
    event.preventDefault();
    const formData = new FormData(event.target);
  
    const MaLop = formData.get("MaLop");
    const ThoiGianBatDau = new Date(formData.get("ThoiGianBatDau"));
    const ThoiGianKetThuc = new Date(formData.get("ThoiGianKetThuc"));
    const ThoiGianDangKy = new Date(formData.get("ThoiGianDangKy"));
    const ThoiGianDongDangKy = new Date(formData.get("ThoiGianDongDangKy"));
    const SoLuongHocVien = formData.get("SoLuongHocVien");
    const DiaDiemHoc = formData.get("DiaDiemHoc");
    const NgayKhaiGiang = new Date(formData.get("NgayKhaiGiang"));
    const HocPhi = formData.get("HocPhi");
    const IDLich = formData.get("IDLich");
  
    // Gửi dữ liệu lên server để thêm vào cơ sở dữ liệu
    $.ajax({
        url: "actionAddLopMonHoc.php",
        type: "POST",
        dataType: "json",
        data: {
            MaLop,
            ThoiGianBatDau: formatDate(ThoiGianBatDau),
            ThoiGianKetThuc: formatDate(ThoiGianKetThuc),
            ThoiGianDangKy: formatDate(ThoiGianDangKy),
            ThoiGianDongDangKy: formatDate(ThoiGianDongDangKy),
            SoLuongHocVien,
            DiaDiemHoc,
            NgayKhaiGiang: formatDate(NgayKhaiGiang),
            HocPhi,
            IDMonHoc: IDLich,
        },
        success: function(response) {
          fetchDataFromServer();
          console.log(response.status);
        },
        error: function(error) {
            console.log("Error adding data:", error);
        }
    });
  
    $("#addEmployeeModal").modal("hide");
};

const handleSubmitEdit = (event) => {
    event.preventDefault();
    const formData = new FormData(event.target);
  
    const MaLop = formData.get("MaLop");
    const ThoiGianBatDau = new Date(formData.get("ThoiGianBatDau"));
    const ThoiGianKetThuc = new Date(formData.get("ThoiGianKetThuc"));
    const ThoiGianDangKy = new Date(formData.get("ThoiGianDangKy"));
    const ThoiGianDongDangKy = new Date(formData.get("ThoiGianDongDangKy"));
    const SoLuongHocVien = formData.get("SoLuongHocVien");
    const DiaDiemHoc = formData.get("DiaDiemHoc");
    const NgayKhaiGiang = new Date(formData.get("NgayKhaiGiang"));
    const HocPhi = formData.get("HocPhi");
    const IDLich = formData.get("IDLich");
  
    $.ajax({
        url: "actionEditLopMonHoc.php",
        type: "POST",
        dataType: "json",
        data: {
            MaLop,
            ThoiGianBatDau: formatDate(ThoiGianBatDau),
            ThoiGianKetThuc: formatDate(ThoiGianKetThuc),
            ThoiGianDangKy: formatDate(ThoiGianDangKy),
            ThoiGianDongDangKy: formatDate(ThoiGianDongDangKy),
            SoLuongHocVien,
            DiaDiemHoc,
            NgayKhaiGiang: formatDate(NgayKhaiGiang),
            HocPhi,
            IDMonHoc: IDLich,
        },
        success: function (response) {
            console.log("Sửa dữ liệu thành công");
            // Sau khi sửa thành công, có thể cần làm mới dữ liệu từ server và cập nhật giao diện
            fetchDataFromServer(); // Cập nhật dữ liệu từ server
            $("#editEmployeeModal").modal("hide");
        },
        error: function (xhr, status, error) {
            console.error("Error editing data:", error);
            fetchDataFromServer(); // Cập nhật dữ liệu từ server
            $("#editEmployeeModal").modal("hide");
        }
    });

    $("#editEmployeeModal").modal("hide");
};
  
  const handleEdit = (id) => {
    console.log(id)
    try {
    idEdit = id;
    const itemToEdit = lopmonhoc.find((item) => item.MaLop === id);
    console.log(itemToEdit);
    const MaLop = document.querySelector(
      '#editEmployeeModal input[name="MaLop"]'
    );
    const ThoiGianBatDau = document.querySelector(
      '#editEmployeeModal input[name="ThoiGianBatDau"]'
    );
    const ThoiGianKetThuc = document.querySelector(
      '#editEmployeeModal input[name="ThoiGianKetThuc"]'
    );
    const ThoiGianDangKy = document.querySelector(
      '#editEmployeeModal input[name="ThoiGianDangKy"]'
    );
    const ThoiGianDongDangKy = document.querySelector(
      '#editEmployeeModal input[name="ThoiGianDongDangKy"]'
    );
    const SoLuongHocVien = document.querySelector(
      '#editEmployeeModal input[name="SoLuongHocVien"]'
    );
    const DiaDiemHoc = document.querySelector(
      '#editEmployeeModal input[name="DiaDiemHoc"]'
    );
    const NgayKhaiGiang = document.querySelector(
      '#editEmployeeModal input[name="NgayKhaiGiang"]'
    );
    const HocPhi = document.querySelector(
      '#editEmployeeModal input[name="HocPhi"]'
    );
    const IDLichSelect = document.getElementById("selectIDLichEdit");
  
    if (itemToEdit) {
      MaLop.value = itemToEdit.MaLop;
      ThoiGianBatDau.value = itemToEdit.ThoiGianBatDau;
      ThoiGianKetThuc.value = itemToEdit.ThoiGianKetThuc;
      ThoiGianDangKy.value = itemToEdit.ThoiGianDangKy;
      ThoiGianDongDangKy.value = itemToEdit.ThoiGianDongDangKy;
      SoLuongHocVien.value = itemToEdit.SoLuongHocVien;
      DiaDiemHoc.value = itemToEdit.DiaDiemHoc;
      NgayKhaiGiang.value = itemToEdit.NgayKhaiGiang;
      HocPhi.value = itemToEdit.HocPhi;
      IDLichSelect.value = itemToEdit.IDMonHoc;
    }
    
} catch (error) {
        console.log(error)
}
  };
  
  const handleDelete = (id) => {
    idEdit = id;
  };
  
  document.getElementById("deleteForm").addEventListener("submit", function (event) {
    event.preventDefault();

    $.ajax({
        url: "actionDeleteLopMonHoc.php",
        type: "POST",
        dataType: "json",
        data: { MaLop: idEdit },
        success: function (response) {
            if (response.status === "success") {
                console.log("Xóa dữ liệu thành công");
                // Sau khi xóa thành công, có thể cần làm mới dữ liệu từ server và cập nhật giao diện
                fetchDataFromServer();
            } else {
                console.error("Error deleting data:", response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error deleting data:", error);
        },
        complete: function () {
            $("#deleteEmployeeModal").modal("hide");
            idEdit = null;
        }
    });
});

  
  const formatDate = (date) => {
    const year = date.getFullYear();
    const month = ("0" + (date.getMonth() + 1)).slice(-2);
    const day = ("0" + date.getDate()).slice(-2);
  
    return `${year}-${month}-${day}`;
  };
  