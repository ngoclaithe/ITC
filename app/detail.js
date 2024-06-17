window.onload = function () {
  var urlParams = new URLSearchParams(window.location.search);
  var maLop = urlParams.get('malop');
  let matchItem = lopmonhoc.find((i) => i?.MaLop === maLop);
  if (matchItem) {
    let matchMonhoc = monhoc.find((i) => i?.IDMonHoc === matchItem?.IDMonHoc);
    if (matchMonhoc) {
      let data = {
        ...matchItem,
        ...matchMonhoc,
      };
      fillData(data);
    } else {
      console.error('Không tìm thấy thông tin môn học');
    }
  } else {
    console.error('Không tìm thấy thông tin lớp học');
  }
};

function fillData(data) {
  let monhoc = document.querySelector("#monhoc");
  let malop = document.querySelector("#malop");
  let hocphi = document.querySelector("#hocphi");
  let lichhoc = document.querySelector("#lichhoc");
  let ngaykhaigiang = document.querySelector("#ngaykhaigiang");
  let diadiemhoc = document.querySelector("#diadiemhoc");
  let tonghocphi = document.querySelector("#tonghocphi");

  if (data) {
    monhoc.innerHTML = data?.TenMonHoc || '';
    malop.innerHTML = data?.MaLop || '';
    hocphi.innerHTML = formatter.format(data?.HocPhi) || '';
    ngaykhaigiang.innerHTML = data?.NgayKhaiGiang || '';
    diadiemhoc.innerHTML = data?.DiaDiemHoc || '';
    tonghocphi.innerHTML = formatter.format(data?.HocPhi) || '';
    lichhoc.innerHTML = `Từ (${data?.ThoiGianBatDau}) đến (${data?.ThoiGianKetThuc})` || '';
  } else {
    console.error('Dữ liệu không hợp lệ');
  }
}

var formatter = new Intl.NumberFormat("vi-VN", {
  style: "currency",
  currency: "VND",
});
