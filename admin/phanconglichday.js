let thoiGianHocData = [];
let lopmonhoc = [];
let tkbData = [];
let tkbData1 = [];
let registerData = [];

window.addEventListener("DOMContentLoaded", () => {
  fetchDataFromServer();
});

const fetchDataFromServer = () => {
  // Gửi yêu cầu ajax để lấy dữ liệu từ server
  $.ajax({
    url: "getDataPhanCong.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      // Gán dữ liệu từ server vào các biến
      tkbData1 = data.tkbData;
      thoiGianHocData = data.thoiGianHocData;
      lopmonhoc = data.lopmonhoc;

      registerData = data.registerData;
      tkbData = Array.from(data.tkbData).map(function (data) {
        const monhoc = lopmonhoc.filter(function (monhoc) {
          return monhoc.MaLop == data.MaLop;
        })[0];
        const gv = registerData.filter(function (gv) {
          return gv.Ma == data.MaGV;
        })[0];
        return { ...gv, ...monhoc };
      });
      // Gọi hàm để hiển thị dữ liệu lên giao diện
      loadOptionGV(registerData);
      loadOptionLOPMONHOC(lopmonhoc);
      loadOptionGVEdit(registerData);
      loadOptionLOPMONHOCEdit(lopmonhoc);
      loadFake(tkbData);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data from server:", error);
    },
  });
};
let idEdit = null;
const loadOptionGV = (value = []) => {
  const selectGV = document.querySelector("#selectGV");
  value.forEach((item) => {
    const option = document.createElement("option");
    option.value = item.Ma;
    option.textContent = `${item.Ma} - ${item.username}`;
    selectGV.appendChild(option);
  });
};

const loadOptionLOPMONHOC = (value = []) => {
  const selectCLASS = document.querySelector("#selectCLASS");
  value.forEach((item) => {
    const option = document.createElement("option");
    option.value = item.MaLop;
    option.textContent = `${item.MaLop}`;
    selectCLASS.appendChild(option);
  });
};
const loadOptionGVEdit = (value = []) => {
  const selectGV = document.querySelector("#selectGVEdit");
  value.forEach((item) => {
    const option = document.createElement("option");
    option.value = item.Ma;
    option.textContent = `${item.Ma} - ${item.username}`;
    selectGV.appendChild(option);
  });
};

const loadOptionLOPMONHOCEdit = (value = []) => {
  const selectCLASS = document.querySelector("#selectCLASSEdit");
  value.forEach((item) => {
    const option = document.createElement("option");
    option.value = item.MaLop;
    option.textContent = `${item.MaLop}`;
    selectCLASS.appendChild(option);
  });
};

const loadFake = (value = []) => {
  console.log('tkbData1', tkbData1)
  console.log('tkbData1',)

  const tBody = document.querySelector("#tBody");
  let txt = "";
  value?.map((i, index) => {
    txt += `
        <tr>
          <td>${i?.MaLop}</td>
          <td>${i?.username}</td>   
          <td>${i?.ThoiGianBatDau}</td>   
          <td>${i?.ThoiGianKetThuc}</td>   
          <td class="td-actions">
              <button 
                onClick="handleEdit(${i?.id})"
                type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm"
                data-original-title="" title=""
                data-toggle="modal" data-target="#modalEdit"
                >
                <i class="material-icons">edit</i>
              </button>
              <button 
                onClick="handleDelete(${tkbData1[index]['id']})"
                type="button" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm"
                data-original-title="" title=""
                data-toggle="modal" data-target="#deleteModal"
                >
                <i class="material-icons">close</i>
              </button>
              <a href="/ITC/admin/quanlylichday.php?idtkb=${tkbData1[index]['id']}">
                <button 
                  type="button" rel="tooltip" class="btn btn-info btn-just-icon btn-sm"
                  >
                  <i class="material-icons">search</i>
                </button>
              </a>
            </td>
          </tr>
      `;
  });
  tBody.innerHTML = txt;
};

const handleEdit = (id) => {
  try {
    idEdit = id;
    const itemToEdit = tkbData.find((item) => item.id === id);

    const selectGVEdit = document.getElementById("selectGVEdit");
    const selectCLASSEdit = document.getElementById("selectCLASSEdit");
    if (itemToEdit) {
      selectGVEdit.value = itemToEdit.MaGV;
      selectCLASSEdit.value = itemToEdit.MaLop;
    }
  } catch (error) {
    console.log(error);
  }
};

const handleAddSubmit = (event) => {
  event.preventDefault();
  try {
    const formData = new FormData(event.target);
    const MaGV = formData.get("MaGV");
    const MaLop = formData.get("MaLop");


    $.ajax({
      url: "insertTKB.php",
      type: "POST",
      data: { MaGV: MaGV, MaLop: MaLop },
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
        fetchDataFromServer();
      },
      error: function (xhr, status, error) {
        fetchDataFromServer();
        console.error("Lỗi khi gửi dữ liệu lên server:", error);
      },
    });
  } catch (error) {
    console.log(error);
  } finally {
  }
};


const handleEditSubmit = (event) => {
  event.preventDefault();
  try {
    const formData = new FormData(event.target);

    const MaGV = formData.get("MaGV");
    const MaLop = formData.get("MaLop");

    // Gửi dữ liệu lên server thông qua AJAX
    $.ajax({
      url: "updateTKB.php", // Đường dẫn tới tệp PHP xử lý yêu cầu
      type: "POST", // Phương thức POST
      data: { MaGV: MaGV, MaLop: MaLop, id: idEdit }, // Dữ liệu gửi đi
      success: function (response) {
        fetchDataFromServer();
        console.log(response.status);
      },
      error: function (error) {
        console.error("Lỗi khi gửi dữ liệu lên server:", error);
      },
    });
  } catch (error) {
    console.log(error);
  } finally {

    fetchDataFromServer()
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

    idEdit = null;
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
      url: "deleteTKB.php",
      type: "POST",
      data: { id: idEdit },
      success: function (response) {
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
        };
      },
      error: function (xhr, status, error) {
        console.error("Lỗi khi gửi yêu cầu xóa lên server:", error);
      },
      finally: function () {
        fetchDataFromServer()
      }
    });
  });

const formatDate = (date) => {
  const year = date.getFullYear();
  const month = ("0" + (date.getMonth() + 1)).slice(-2);
  const day = ("0" + date.getDate()).slice(-2);

  return `${year}-${month}-${day}`;
};
