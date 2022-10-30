const imgInput = document.querySelector("#picture-input");
const pictureImage = document.querySelector(".picture-image");
pictureImage.innerHTML = "Escolha uma imagem";

imgInput.addEventListener("change", function (e) {
  const inputTarget = e.target;
  const file = inputTarget.files[0];

  if (file) {
    const reader = new FileReader();

    reader.addEventListener("load", function (e) {
      const readerTarget = e.target;

      const img = document.createElement("img");
      img.src = readerTarget.result;
      img.classList.add("picture-img");

      pictureImage.innerHTML = "";
      pictureImage.appendChild(img);
    });

    reader.readAsDataURL(file);
  } else {
    pictureImage.innerHTML = "Escolha uma imagem";
  }
});

const topicForm = document.querySelector("#topic-form");
const inputHidden = document.getElementsByName("operation");

const newTopicBtn = document.querySelector("#new-topic-btn");
newTopicBtn.addEventListener("click", async function (e) {
  e.preventDefault();
  
  inputHidden.name = "insert";
});

const editTopicBtn = document.querySelector(".edit-btn");

editTopicBtn.addEventListener("click", async function (e) {
  e.preventDefault();

  inputHidden.name = "update";

  const url = this.getAttribute("href");
  const data = await fetch(url, {
    method: "GET",
  }).catch(function (error) {
    console.error(error);
  });

  const res = await data.json();
  document.querySelector("#topic-title").value = res.titulo;
  pictureImage.innerHTML = "Selecione a nova imagem...";
  inputHidden.value = res.id;
});

topicForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  const dataForm = new FormData(topicForm);

  if(inputHidden.name == "insert"){
    const searchParams = new URLSearchParams(dataForm);
    for(const param of dataForm) {
      searchParams.append(param[0], param[1], param[2]);
    }
    console.log(searchParams);

    const data = await fetch("./insert.php", {
      method: "POST",
      body: dataForm
    }).catch(function (error) {
      console.error(error);
    });

    const res = await data.json();
    console.log(res);
  }

  if(inputHidden.name == "update"){
    var data = await fetch(`./update.php?id=${inputHidden.value}`, {
      method: "POST",
      body: dataForm
    }).catch(function (error) {
      console.error(error);
    });

    const res = await data.json();
    console.log(res);
  }
});
