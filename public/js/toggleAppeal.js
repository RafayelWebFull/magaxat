const showPaymentFormBtn = document.querySelector(".pdf-button-one-wrapper");
const showPaymentDetails = document.querySelector(".pdf-button-two-wrapper");
const appealIdBtn = document.querySelector(".appeal-id-btn-wrapper");
const paymentWrapper = document.querySelector(".currency-wrapper");
const paymentData = document.querySelector(".trans-data");

const submitPaymentForm = (e) => {
    e.preventDefault();
    const transInput = document.querySelector(".trans-input");
    if (transInput.value === "") {
        return false;
    }
};

const togglePaymentDetailsWrapper = (e) => {
    paymentData.classList.toggle("s-trans");
    paymentData.classList.toggle("h-trans");
};

const togglePaymentDiv = () => {
    paymentWrapper.innerHTML = `
    <span class="trans-title">Выбрать сумму</span>
    <form action="" class="trans-form">
      <div class="trans-wrapper">
        <input type="text" class="trans-input">
        <select name="" id="" class="trans-list">
          <option class="trans-option" value="РУБ">РУБ</option>
          <option class="trans-option" value="USD">USD</option>
          <option class="trans-option" value="AMD">AMD</option>
        </select>
      </div>
      <button class="trans-link" href="">оплатить</button>
    </form>
    `;

    const paymentForm = document.querySelector(".trans-form");
    paymentForm.addEventListener("submit", submitPaymentForm);
};

// showPaymentFormBtn.addEventListener("click", togglePaymentDiv);
showPaymentDetails.addEventListener("click", togglePaymentDetailsWrapper);
appealIdBtn.addEventListener("click", togglePaymentDetailsWrapper);
