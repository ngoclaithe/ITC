let lichkhaigiang = [];
let monhoc = [];
let lopmonhoc = [];

window.addEventListener("DOMContentLoaded", () => {
  fetchDataFromServer();
});

const fetchDataFromServer = () => {
  $.ajax({
    url: "../getDataLichKhaiGiang.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      lichkhaigiang = data.lichkhaigiang;
      monhoc = data.monhoc;
      lopmonhoc = data.lopmonhoc;

      console.log("lichkhaigiang:", lichkhaigiang);
      console.log("monhoc:", monhoc);
      console.log("lopmonhoc:", lopmonhoc);

      fakeDbFc(lichkhaigiang);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data from server:", error);
    },
  });
};

let idEdit = null;

const fakeDbFc = (value = []) => {
  let bodyId = document.querySelector("#body");
  let txt = "";
  value?.map((i) => {
    txt += `<tr>
                <td>${i?.TenMon}</td>
                <td>${new Date(i?.NgayBatDau)?.toLocaleDateString()}</td>
                <td>
                    <a onClick="handleEdit(${i?.IDLich})" href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
                            data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a onClick="handleDelete(${i?.IDLich})" href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons"
                            data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                </td>
            </tr>`;
  });
  bodyId.innerHTML = txt;
};

const handleChange = (event) => {
  console.log(event.target.value);
};

const handleSubmitAdd = (event) => {
  event.preventDefault();
  const formData = new FormData(event.target);

  const TenMon = formData.get("TenMon");
  const NgayBatDau = formData.get("NgayBatDau");

  const dataSubmit = {
      TenMon,
      NgayBatDau: formatDateLich(new Date(NgayBatDau)),
  };

  $.ajax({
      url: "addLichKhaiGiang.php",
      type: "POST",
      dataType: "json",
      data: dataSubmit,
      success: function (response) {
          console.log("Thêm dữ liệu thành công");
          fetchDataFromServer();
      },
      error: function (xhr, status, error) {
          console.error("Error adding data:", error);
      },
  });

  $("#addEmployeeModal").modal("hide");
};

const handleSubmitEdit = (event) => {
  event.preventDefault();
  const formData = new FormData(event.target);

  const TenMon = formData.get("TenMon");
  const NgayBatDau = new Date(formData.get("NgayBatDau"));

  const updatedItem = {
      TenMon,
      NgayBatDau: formatDateLich(NgayBatDau),
      IDLich: idEdit,
  };

  $.ajax({
      url: "editLichKhaiGiang.php",
      type: "POST",
      dataType: "json",
      data: updatedItem,
      success: function (response) {
          console.log("Chỉnh sửa dữ liệu thành công");
          fetchDataFromServer();
      },
      error: function (xhr, status, error) {
          console.error("Error editing data:", error);
      },
  });

  idEdit = null;
  $("#editEmployeeModal").modal("hide");
};

const handleEdit = (id) => {
  idEdit = id;
  const itemToEdit = lichkhaigiang.find((item) => item.IDLich === id);

  const subjectInput = document.querySelector(
    '#editEmployeeModal input[name="TenMon"]'
  );
  const startDateInput = document.querySelector(
    '#editEmployeeModal input[name="NgayBatDau"]'
  );
  if (itemToEdit) {
    subjectInput.value = itemToEdit.TenMon;
    startDateInput.value = new Date(itemToEdit.NgayBatDau)
      ?.toISOString()
      .slice(0, 10);
  }
};

const handleDelete = (id) => {
  idEdit = id;
};

document.getElementById("deleteForm").addEventListener("submit", function (event) {
  event.preventDefault();

  $.ajax({
      url: "deleteLichKhaiGiang.php",
      type: "POST",
      dataType: "json",
      data: { IDLich: idEdit },
      success: function (response) {
          console.log("Xóa dữ liệu thành công");
          fetchDataFromServer();
      },
      error: function (xhr, status, error) {
          console.error("Error deleting data:", error);
      },
  });

  $("#deleteEmployeeModal").modal("hide");
  idEdit = null;
});
const formatDateLich = (date) => {
  const year = date.getFullYear();
  const month = ("0" + (date.getMonth() + 1)).slice(-2);
  const day = ("0" + date.getDate()).slice(-2);

  return `${year}-${month}-${day}`;
};