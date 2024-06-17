let tkbDetailsDataPage = [];
let thoiGianHocData2 = [];

// Lấy dữ liệu từ file PHP sử dụng AJAX
const fetchDataFromServer2 = () => {
  // Gửi yêu cầu ajax để lấy dữ liệu từ server
  $.ajax({
    url: "getDataThoiGianDay.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      tkbDetailsDataPage = data.tkbdetails;
      thoiGianHocData2 = data.thoi_gian_hoc;

      fillData(tkbDetailsDataPage);
      loadOptionThoiGianHoc(thoiGianHocData2);
      loadOptionThoiGianHocEdit(thoiGianHocData2);
      console.log(tkbDetailsDataPage);
      console.log(thoiGianHocData2);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data from server:", error);
    },
  });
};
window.addEventListener("DOMContentLoaded", () => {
  fetchDataFromServer2();
});

let idEdit = null;
const fillData = (value) => {
  console.log('fillData', value)
  var urlParams = window.location.search.slice(
    1,
    window.location.search.length
  );

  const number = parseInt(urlParams.split("=")[1]);

  let list = value.filter((i) => i?.idtkb == number);
  console.log(number); // Kết quả sẽ là 9
  const tBody = document.querySelector("#tBody");
  let txt = "";
  list?.map((i, index) => {
    let findItem = thoiGianHocData2.find((it) => it?.IDThoiGianHoc == i?.idThoiGianHoc);
    console.log(findItem)
    txt += `
        <tr>
          <td>${formatDate(new Date(i?.ngayday))}</td>
          <td>${i?.phongday}</td>   
          <td>${findItem?.ThoiGian || ""}</td>   
          <td class="td-actions">
              <button 
                onClick="handleEdit(${i?.idtkbdetails})"
                type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm"
                data-original-title="" title=""
                data-toggle="modal" data-target="#modalEdit"
                >
                <i class="material-icons">edit</i>
              </button>
              <button 
                onClick="handleDelete(${i?.idtkbdetails})"
                type="button" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm"
                data-original-title="" title=""
                data-toggle="modal" data-target="#deleteModal"
                >
                <i class="material-icons">close</i>
              </button>
            </td>
          </tr>
      `;
  });
  tBody.innerHTML = txt;
};

const loadOptionThoiGianHoc = (value = []) => {
  const IDThoiGianHoc = document.querySelector("#IDThoiGianHoc");
  IDThoiGianHoc.innerHTML = ""
  value.forEach((item) => {
    const option = document.createElement("option");
    option.value = item.IDThoiGianHoc;
    option.textContent = `${item.ThoiGian}`;
    IDThoiGianHoc.appendChild(option);
  });
};

const loadOptionThoiGianHocEdit = (value = []) => {
  const IDThoiGianHocEdit = document.querySelector("#IDThoiGianHocEdit");
  IDThoiGianHocEdit.innerHTML = ""
  value.forEach((item) => {
    const option = document.createElement("option");
    option.value = item.IDThoiGianHoc;
    option.textContent = `${item.ThoiGian}`;
    IDThoiGianHocEdit.appendChild(option);
  });
};

const handleAddSubmitLick = (event) => {
  event.preventDefault();

  try {
    const formData = new FormData(event.target);
    const ngayday = formData.get("ngayday");
    const phongday = formData.get("phongday");
    const IDThoiGianHoc = document.getElementById("IDThoiGianHoc");
    const idtkb = formData.get("idtkb");
    console.log(IDThoiGianHoc.value)
    //Gửi dữ liệu lên server sử dụng AJAX
    $.ajax({
      url: "insertLichDayTC.php",
      type: "POST",
      data: {
        ngayday: ngayday,
        phongday: phongday,
        IDThoiGianHoc: IDThoiGianHoc?.value,
        idtkb: +idtkb
      },
      success: function (response) {

        const modalAdd = document.getElementById("modalAdd");

        // Ẩn modal bằng cách loại bỏ lớp 'show'
        modalAdd.classList.remove("show");

        // Ẩn modal bằng cách đặt style 'display' thành 'none'
        modalAdd.style.display = "none";

        // Xóa lớp 'modal-open' trên body (nếu có)
        document.body.classList.remove("modal-open");

        // Xóa lớp 'modal-backdrop' (nền đen) khỏi body (nếu có)
        const backdrop = document.querySelector(".modal-backdrop");
        if (backdrop) {
          backdrop.remove();
        }
        fetchDataFromServer2();
      },
      error: function (xhr, status, error) {
        console.error("Error inserting data to database:", error);
      }

    });
  } catch (error) {
    console.log(error);
  } finally {
    const ngayday = document.querySelector('#modalAdd input[name="ngayday"]');
    const phongday = document.querySelector('#modalAdd input[name="phongday"]');
    const IDThoiGianHoc = document.getElementById("IDThoiGianHoc");
    ngayday.value = null;
    phongday.value = null;
    IDThoiGianHoc.value = null;
  }
};


const handleEdit = (id) => {
  try {
    idEdit = id;
    const itemToEdit = tkbDetailsDataPage.find((item) => +item.idtkbdetails === id);
    const ngayday = document.querySelector('#modalEdit input[name="ngayday"]');
    const phongday = document.querySelector(
      '#modalEdit input[name="phongday"]'
    );
    const IDThoiGianHocEdit = document.getElementById("IDThoiGianHocEdit");
    if (itemToEdit) {
      ngayday.value = itemToEdit.ngayday;
      phongday.value = itemToEdit.phongday;
      IDThoiGianHocEdit.value = +itemToEdit.idThoiGianHoc;
    }
  } catch (error) {
    console.log(error);
  }
};

const handleEditSubmit = (event) => {
  event.preventDefault();
  try {
    const formData = new FormData(event.target);

    const ngayday = formData.get("ngayday");
    const phongday = formData.get("phongday");
    const IDThoiGianHoc = document.getElementById("IDThoiGianHocEdit");
    const data = {
      ngayday: formatDateDto(new Date(ngayday)),
      phongday,
      IDThoiGianHoc: IDThoiGianHoc.value,
      id: idEdit,
    };

    // Gửi yêu cầu AJAX
    $.ajax({
      url: "editThoiGianDay.php",
      type: "POST",
      data: data,
      success: function (response) {

        fetchDataFromServer2();
        const modalEdit = document.getElementById("modalEdit");

        // Ẩn modal bằng cách loại bỏ lớp 'show'
        modalEdit.classList.remove("show");

        // Ẩn modal bằng cách đặt style 'display' thành 'none'
        modalEdit.style.display = "none";

        // Xóa lớp 'modal-open' trên body (nếu có)
        document.body.classList.remove("modal-open");

        // Xóa lớp 'modal-backdrop' (nền đen) khỏi body (nếu có)
        const backdrop = document.querySelector(".modal-backdrop");
        if (backdrop) {
          backdrop.remove();
        }
      },

      error: function (xhr, status, error) {
        console.error("Error:", error);
      }
    });
  } catch (error) {
    console.log(error);
  } finally {
    fetchDataFromServer2();
  }
};


const handleDelete = (id) => {
  idEdit = id;
};

document
  .getElementById("deleteForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    $.ajax({
      url: "deleteThoiGianDay.php",
      type: "POST",
      data: { id: idEdit }, // Truyền id cần xóa
      success: function (response) {
        idEdit = null;
        const deleteModal = document.getElementById("deleteModal");

        // Ẩn modal bằng cách loại bỏ lớp 'show'
        deleteModal.classList.remove("show");

        // Ẩn modal bằng cách đặt style 'display' thành 'none'
        deleteModal.style.display = "none";

        // Xóa lớp 'modal-open' trên body (nếu có)
        document.body.classList.remove("modal-open");

        // Xóa lớp 'modal-backdrop' (nền đen) khỏi body (nếu có)
        const backdrop = document.querySelector(".modal-backdrop");
        if (backdrop) {
          backdrop.remove();
        }
        fetchDataFromServer2();
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      }
    });
    idEdit = null;
    $("#deleteModal").modal("hide");
    fetchDataFromServer2();
  });

const formatDate = (date) => {
  const year = date.getFullYear();
  const month = ("0" + (date.getMonth() + 1)).slice(-2);
  const day = ("0" + date.getDate()).slice(-2);

  return `${day}-${month}-${year}`;
};

const formatDateDto = (date) => {
  const year = date.getFullYear();
  const month = ("0" + (date.getMonth() + 1)).slice(-2);
  const day = ("0" + date.getDate()).slice(-2);

  return `${year}-${month}-${day}`;
};
