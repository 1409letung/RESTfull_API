const submit = document.getElementById("submit");
const cautraloi = document.querySelectorAll(".cautraloi");
const quiz = document.getElementById("question");

let cauhoi_hientai = 0;
let socaudung = 0;
let score = 0;

loadQuestion();
function loadQuestion() {
  submit.disabled = true;
  removeAnswer();
  fetch("http://localhost/RESTfull_API/API/Question/Read.php")
    .then((res) => res.json())
    .then((data) => {
      document.getElementById("tongsocauhoi").value = data.Question.length;
      //alert(document.getElementById("tongsocauhoi").value);
      const cauhoi = document.getElementById("title");

      const a_cautraloi = document.getElementById("a_cautraloi");
      const b_cautraloi = document.getElementById("b_cautraloi");
      const c_cautraloi = document.getElementById("c_cautraloi");
      const d_cautraloi = document.getElementById("d_cautraloi");

      //show Question
      const getQuestion = data.Question[cauhoi_hientai];
      //console.log(getQuestion);

      cauhoi.innerText = getQuestion.title;
      a_cautraloi.innerText = getQuestion.cau_a;
      b_cautraloi.innerText = getQuestion.cau_b;
      //kiểm tra xem cau_c có data không
      if (getQuestion.cau_c != null) {
        //document.getElementById("cau_c").classList.remove("hienthicautraloi");
        c_cautraloi.innerText = getQuestion.cau_c;
      } else {
        document.getElementById("cau_c").classList.add("hienthicautraloi");
      }
      //kiểm tra xem cau_d có data không
      if (getQuestion.cau_d != null) {
        //document.getElementById("cau_d").classList.remove("hienthicautraloi");
        d_cautraloi.innerText = getQuestion.cau_d;
      } else {
        document.getElementById("cau_d").classList.add("hienthicautraloi");
      }

      //đẩy dữ liệu câu đúng vào id"cau dung"
      document.getElementById("caudung").value = getQuestion.caudung;
      //alert(document.getElementById("caudung").value);
    })
    .catch((error) => console.log(error));
}

//choose answer
function getAnswer() {
  let answer = undefined;
  cautraloi.forEach((cautraloi) => {
    if (cautraloi.checked) {
      answer = cautraloi.id;
    }
  });
  return answer;
}
//remove answer
function removeAnswer() {
  cautraloi.forEach((cautraloi) => {
    cautraloi.checked = false;
  });
}

//check to next question
cautraloi.forEach((element) => {
  element.addEventListener("change", function (event) {
    submit.removeAttribute("disabled");
  });
});
//event click button submit
submit.addEventListener("click", () => {
  const answer = getAnswer();
  if (answer) {
    if (answer === document.getElementById("caudung").value) {
      socaudung++;
      score = score + 10;
    }
  }
  //console.log(answer);
  cauhoi_hientai++;
  loadQuestion();

  if (cauhoi_hientai < document.getElementById("tongsocauhoi").value) {
    loadQuestion();
  } else {
    const tongsocauhoi = document.getElementById("tongsocauhoi").value;
    quiz.innerHTML = `
      <h2>Bạn đã đúng ${socaudung}/${tongsocauhoi} câu hỏi!!</h2>
      <p>Đạt được: ${score} điểm</p>
      <button onclick="location.reload()">Làm lại bài thi</button>
    `;
  }
});
