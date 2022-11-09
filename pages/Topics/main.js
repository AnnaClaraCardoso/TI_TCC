const card_header = document.querySelectorAll(".card-header");

card_header.forEach((header) => {
  header.addEventListener("click", function (e) {
    e.preventDefault();

    const id = this.getAttribute("id");
    const title = this.querySelector(".card-title>h2").innerText;
    window.location.href = `./topic.php?id=${id}&titulo=${title}`;
  });
});

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

const editTopicBtn = document.querySelectorAll(".edit-btn");

editTopicBtn.forEach((btn) => {
  btn.addEventListener("click", async function (e) {
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
});


const deleteTopicBtn = document.querySelectorAll(".delete-btn");
deleteTopicBtn.forEach((btn) => {
  btn.addEventListener("click", async function (e) {
    e.preventDefault();

    const url = this.getAttribute("href");
    const data = await fetch(url, {
      method: "GET",
    }).catch(function (error) {
      console.error(error);
    });

    const res = await data.json();
    console.log(res);
  });
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
    await fetch(`./update.php?id=${inputHidden.value}`, {
      method: "POST",
      body: dataForm
    })
    .then((res) => res.json())
    .then((data) => console.log(data))
    .catch((error) => console.error(error));
  }

  window.location.href = "./essay_topics.php";
});