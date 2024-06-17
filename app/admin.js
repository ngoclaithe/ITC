let fakeDb = [
  {
    subject: "Toan",
    startDate: new Date(),
    endDate: new Date(),
    id: Math.floor(Math.random() * 1000),
  },
  {
    subject: "Toan",
    startDate: new Date(),
    endDate: new Date(),
    id: Math.floor(Math.random() * 1000),
  },
];

let idEdit = null;

window.addEventListener("DOMContentLoaded", () => {
  fakeDbFc(fakeDb);
});

const fakeDbFc = (value = []) => {
  let bodyId = document.querySelector("#body");
  let txt = "";
  value?.map((i) => {
    txt += `<tr>
                <td>${i?.subject}</td>
                <td>${i?.startDate?.toLocaleDateString()}</td>
                <td>${i?.endDate?.toLocaleDateString()}</td>
                <td>
                    <a onClick="handleEdit(${
                      i?.id
                    })" href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
                            data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a onClick="handleDelete(${
                      i?.id
                    })" href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons"
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

  const subject = formData.get("subject");
  const startDate = formData.get("startDate");
  const endDate = formData.get("endDate");

  const dataSubmit = {
    subject,
    startDate: new Date(startDate),
    endDate: new Date(endDate),
    id: Math.floor(Math.random() * 1000),
  };
  fakeDb.push(dataSubmit);
  fakeDbFc(fakeDb);
  $("#addEmployeeModal").modal("hide");
};

const handleSubmitEdit = (event) => {
  event.preventDefault();
  const formData = new FormData(event.target);

  const subject = formData.get("subject");
  const startDate = new Date(formData.get("startDate"));
  const endDate = new Date(formData.get("endDate"));

  const updatedItem = {
    subject,
    startDate,
    endDate,
    id: idEdit,
  };

  const index = fakeDb.findIndex((item) => item.id === updatedItem.id);
  if (index !== -1) {
    fakeDb[index] = updatedItem;
  }

  fakeDbFc(fakeDb);
  idEdit = null;
  $("#editEmployeeModal").modal("hide");
};

const handleEdit = (id) => {
  idEdit = id;

  const itemToEdit = fakeDb.find((item) => item.id === id);

  const subjectInput = document.querySelector(
    '#editEmployeeModal input[name="subject"]'
  );
  const startDateInput = document.querySelector(
    '#editEmployeeModal input[name="startDate"]'
  );
  const endDateInput = document.querySelector(
    '#editEmployeeModal input[name="endDate"]'
  );

  if (itemToEdit) {
    subjectInput.value = itemToEdit.subject;
    startDateInput.value = itemToEdit.startDate.toISOString().slice(0, 10);
    endDateInput.value = itemToEdit.endDate.toISOString().slice(0, 10);
  }
};

const handleDelete = (id) => {
  idEdit = id;
};

document
  .getElementById("deleteForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const index = fakeDb.findIndex((item) => item.id === idEdit);

    if (index !== -1) {
      fakeDb.splice(index, 1);

      fakeDbFc(fakeDb);

      $("#deleteEmployeeModal").modal("hide");
      idEdit = null;
    }
  });
