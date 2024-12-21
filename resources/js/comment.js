import axios from "axios";

axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
axios.defaults.headers.common["X-CSRF-TOKEN"] = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

const addBtn = document.getElementById("addCommentBtn");
const addCommentDiv = document.getElementById("addComment");

let addComentAttive = false;

if (addBtn && addCommentDiv) {
    addBtn.addEventListener("click", () => {
        if (addComentAttive) {
            addComentAttive = false;
            addCommentDiv.classList.add("d-none");
            addBtn.innerText = "add comment";
        } else {
            addComentAttive = true;
            addCommentDiv.classList.remove("d-none");
            addBtn.innerText = "cancel";
        }
    });
}

const submit = document.getElementById("submitComment");
const form = document.getElementById("commentsForm");
const ratingField = document.getElementById("inputRating");
const nameField = document.getElementById("inputName");
const commentField = document.getElementById("inputComment");
const commentList = document.getElementById("commentList");
let submitting = false

if (submit && form) {
    submit.addEventListener("click", (e) => {      
        e.preventDefault();       
        submitForm();
    });
}

async function submitForm() {
    if(submitting) return
    submitting = true
    const formData = new FormData(form);
    clearErrors();
    submit.innerHTML = '<div class="loader "></div>'
    try {
        const response = await axios.post("/comments", formData);
        const data = response.data;   
        commentList.innerHTML = commentHTml(data) + commentList.innerHTML
        resetForm()
        addComentAttive = false;
        addCommentDiv.classList.add("d-none");
        addBtn.innerText = "add comment";
    } catch (e) {       
        if (e.response) {
            errorPrint(e.response.data.errors);
        }
    }finally{
         submit.innerHTML = 'submit'
         submitting = false     
    }
}

function commentHTml(comment) {
    return ` <article class="commnts__box">
                <div class="commnts__info">
                    <div class="comments__author">
                        <figure class="comments__author-img-wrap">
                            <img class="comments__author-img" loading="lazy" src="/images/user.webp" alt="user image">
                        </figure>

                        <p class="comments__author-name">${comment.user_name}</p>
                    </div>
                    ${ratingHTml(+comment.rating)}   
                </div>

                <p class="comments__text">${comment.comment}</p>
            </article>`;
}

function ratingHTml(score){
    const rating = Math.round(score); 
    const fullStars = Math.floor(score);
    const halfStars = Math.ceil(score - fullStars);
    const emptyStars = 10 - (fullStars + halfStars);

    let html = '<div class="rating">';

    for (let i = 0; i < fullStars; i++) {
        html += '<i class="fa-solid fa-star"></i>';
    }

    if (halfStars > 0) {
        html += '<i class="fa-solid fa-star-half-stroke"></i>';
    }
 
    for (let i = 0; i < emptyStars; i++) {
        html += '<i class="fa-regular fa-star"></i>';
    }

    html += `<span class="rating__grade">(${rating})</span></div>`;
   return  html
}

function clearErrors() {
    form.querySelectorAll(".jsError").forEach((item) => (item.innerText = ""));
}

function resetForm() {
    form.querySelectorAll(".jsInput").forEach((item) => (item.value = ""));
    form.querySelectorAll(".jsRadio").forEach((item) => (item.checked = false));
}

function errorPrint(errors) {
    if (errors.comment) {
        const print = commentField.querySelector(".jsError");
        print.innerText = errors.comment.join(", ");
    }
    if (errors.user_name) {
        const print = nameField.querySelector(".jsError");
        print.innerText = errors.user_name.join(", ");
    }
    if (errors.rating) {
        const print = ratingField.querySelector(".jsError");
        print.innerText = errors.rating.join(", ");
    }
}

const radioButtons = document.querySelectorAll(".jsRadio");
let selectedValue = 0;

radioButtons.forEach((item, index) => {
    item.addEventListener("click", () => {
        if (item.checked) {
            selectedValue = item.value;
            radioButtons.forEach((el) => {
                if (+el.value <= +selectedValue) {
                    el.parentElement.classList.add("activeClass");
                } else {
                    el.parentElement.classList.remove("activeClass");
                }
            });
        }
    });
});
