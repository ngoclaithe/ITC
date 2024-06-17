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
    url: "getDataLichKhaiGiang.php",
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

      // Gọi hàm để hiển thị dữ liệu lên giao diện
      fakeDbFc(lichkhaigiang);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data from server:", error);
    },
  });
};

console.log(lichkhaigiang);
console.log(monhoc);
console.log(lopmonhoc);
window.addEventListener("DOMContentLoaded", () => {
  fakeDbFc(lichkhaigiang);
});

const fakeDbFc = (value = []) => {
  let listCalendar = document.querySelector("#listCalendar"); // Sửa tên biến thành listCalendar
  let txt = "";
  value?.map((i) => {
    txt += `<div class="item1" data-id="${i.IDLich}">
                <div>
                    <div>
                        <img class="w-3" src="https://cdn-icons-png.flaticon.com/512/8818/8818517.png" />
                    </div>
                </div>
                <div>
                    <div>${i.NgayBatDau}</div>
                    <div>${i.TenMon}</div>
                </div>
            </div>`;
  });
  listCalendar.innerHTML = txt;

  document.querySelectorAll(".item1").forEach((item) => {
    item.addEventListener("click", () => {
      handleSetItem(item.dataset.id);
    });
  });
};

const handleSetItem = (id) => {
  let body = document.querySelector("#body");
  const matchItem = monhoc.filter((i) => String(i?.IDLich) === id);
  if (matchItem.length > 0) {
    let txt = "";
    matchItem?.map((i) => {
      txt += `
          <div>
            <div class="border-custom" data-toggle="collapse" data-target="#collapse-${
              i.IDMonHoc
            }" aria-expanded="false" aria-controls="collapse-${i.IDMonHoc}">
              ${i?.TenMonHoc}
            </div>
            <div class="collapse" id="collapse-${i.IDMonHoc}">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="min-width: 300px;">Lớp</th>
                        <th>Thời gian</th>
                        <th>Ngày khai giảng</th>
                        <th>Địa điểm học</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                  ${lopmonhoc
                    ?.filter((item) => item?.IDMonHoc === i.IDMonHoc)
                    .map((itemChild) => {
                      return `
                      <tr>
                        <td> ${itemChild?.MaLop}</td>
                        <td> ${itemChild?.ThoiGianDangKy}</td>
                        <td>${itemChild?.ThoiGianBatDau}</td>
                        <td>${itemChild?.DiaDiemHoc}</td>
                        <td><button type="button" class="btn btn-primary"><a href="/ITC/detail.php?malop=${itemChild?.MaLop}">Đăng ký</a></button></td>
                      </tr>
                    `;
                    })}
              
                </tbody>
              </table>
            </div>
          </div>
        `;
    });
    body.innerHTML = txt;
  } else {
    body.innerHTML = "Không có thông tin lớp môn học cho môn này";
  }
};


