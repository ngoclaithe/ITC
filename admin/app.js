let btnPrev = document.querySelector("#prev");
let btnNext = document.querySelector("#next");
var currentDate = new Date();
const currentDayOfWeek = currentDate.getDay();
if (currentDayOfWeek !== 1) {
  const daysToSubtract = currentDayOfWeek === 0 ? 6 : currentDayOfWeek - 1;
  currentDate.setDate(currentDate.getDate() - daysToSubtract);
}

const populateTable = (data, currentDate) => {
  let headerRow = document.querySelector("#headerRow");
  let sangRow = document.querySelector("#sangRow");
  let truaRow = document.querySelector("#truaRow");
  let chieuRow = document.querySelector("#chieuRow");
  let toiRow = document.querySelector("#toiRow");

  let header = `<th class="text-uppercase">Thời gian</th>`;
  let sang = `<td class="align-middle">Sáng</td>`;
  let trua = `<td class="align-middle">Trưa</td>`;
  let chieu = `<td class="align-middle">Chiều</td>`;
  let toi = `<td class="align-middle">Tối</td>`;

  let nextDate = new Date(currentDate);
  for (let index = 0; index < 7; index++) {
    let dd = String(nextDate.getDate()).padStart(2, "0");
    let mm = String(nextDate.getMonth() + 1).padStart(2, "0");
    let yyyy = nextDate.getFullYear();
    let formattedDate = dd + "-" + mm + "-" + yyyy;
    let formattedDate2 = dd + "/" + mm + "/" + yyyy;
    let formattedDate3 = yyyy + "-" + mm + "-" + dd;

    header += `<th>
                <div>${getDayOfWeek(formattedDate3)}</div>
                <div>${formattedDate2}</div>
              </th>`;

    let matchedItemSang = data?.sang?.find((i) => i?.date === formattedDate);
    if (matchedItemSang) {
      sang += ` <td>
      <span
          class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">${matchedItemSang?.cv}</span>
      <div class="margin-10px-top font-size14">${matchedItemSang?.cvid}</div>
      <div class="font-size13 text-light-gray">${matchedItemSang?.phonghoc}</div>
  </td>`;
    } else {
      sang += ` <td></td>`;
    }

    let matchedItemTrua = data?.trua?.find((i) => i?.date === formattedDate);
    if (matchedItemTrua) {
      trua += ` <td>
      <span
          class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">${matchedItemTrua?.cv}</span>
      <div class="margin-10px-top font-size14">${matchedItemTrua?.cvid}</div>
      <div class="font-size13 text-light-gray">${matchedItemTrua?.phonghoc}</div>
  </td>`;
    } else {
      trua += ` <td></td>`;
    }

    let matchedItemChieu = data?.chieu?.find((i) => i?.date === formattedDate);
    if (matchedItemChieu) {
      chieu += ` <td>
      <span
          class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">${matchedItemChieu?.cv}</span>
      <div class="margin-10px-top font-size14">${matchedItemChieu?.cvid}</div>
      <div class="font-size13 text-light-gray">${matchedItemChieu?.phonghoc}</div>
  </td>`;
    } else {
      chieu += ` <td></td>`;
    }

    let matchedItemToi = data?.toi?.find((i) => i?.date === formattedDate);
    if (matchedItemToi) {
      toi += ` <td>
      <span
          class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">${matchedItemToi?.cv}</span>
      <div class="margin-10px-top font-size14">${matchedItemToi?.cvid}</div>
      <div class="font-size13 text-light-gray">${matchedItemToi?.phonghoc}</div>
  </td>`;
    } else {
      toi += ` <td></td>`;
    }

    let nextDateCopy = new Date(nextDate);
    nextDateCopy.setDate(nextDateCopy.getDate() + 1);

    nextDate = nextDateCopy;
  }

  headerRow.innerHTML = header;
  sangRow.innerHTML = sang;
  truaRow.innerHTML = trua;
  chieuRow.innerHTML = chieu;
  toiRow.innerHTML = toi;
};

document.getElementById("prev").addEventListener("click", function () {
  currentDate.setDate(currentDate.getDate() - 7);
  getDataAndUpdateTable();
});

document.getElementById("next").addEventListener("click", function () {
  currentDate.setDate(currentDate.getDate() + 7);
  getDataAndUpdateTable();
});

function getDataAndUpdateTable() {
  // Sử dụng AJAX để gửi yêu cầu GET đến getTKB.php
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "getTKB.php", true);
  xhr.onload = function () {
    if (xhr.status == 200) {
      // Xử lý dữ liệu JSON được trả về
      let data = JSON.parse(xhr.responseText);
      // Cập nhật bảng
      populateTable(data, currentDate);
    }
  };
  xhr.send();
}

// Khởi chạy hàm để lấy dữ liệu ban đầu khi trang được tải
getDataAndUpdateTable();

function formatDate(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();

  day = day < 10 ? "0" + day : day;
  month = month < 10 ? "0" + month : month;

  return day + "-" + month + "-" + year;
}

function getDayOfWeek(value) {
  const date = new Date(value);
  const dayOfWeek = date.getDay();

  const daysOfWeek = [
    "Chủ nhật",
    "Thứ Hai",
    "Thứ Ba",
    "Thứ Tư",
    "Thứ Năm",
    "Thứ Sáu",
    "Thứ Bảy",
  ];

  return daysOfWeek[dayOfWeek];
}
