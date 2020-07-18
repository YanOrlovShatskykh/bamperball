document.addEventListener('DOMContentLoaded', () => {
  const btnRent = document.getElementById('js-btn-rent');
  const modal = document.getElementById('modal');
  const btnCloseModal = document.getElementById('close');
  const btnCloseModalThanks = document.getElementById('close-thanks');
  const whatOrder = document.getElementById('js-whatOrder');
  const playWithUs = document.getElementById('js-btn-playWithUs');
  const playWithYou = document.getElementById('js-btn-playWithYou');
  const catering = document.getElementById('js-btn-catering');
  const sendBtn = document.querySelector('.brif__button');
  const form = document.getElementById('brif-form');
  const modalThanks = document.getElementById('modal-t');
  const video = document.querySelector('.main-header__video');
  const volume = document.querySelector('.main-header__music-button');
  const formData = new FormData();
  
  const openModal = event => {
    event.preventDefault();
    const target = event.target;
    modal.classList.add('modal_active');
    modal.addEventListener('click', closeModal);
    document.addEventListener('keydown', closeModal);
    let order = target.dataset.order;
    whatOrder.dataset.whatOrder = order;
  };

  const closeModal = event => {
    const target = event.target;

    if(target.classList.contains('modal_active') ||
      target.classList.contains('modal-dialog__close') ||
      event.keyCode == 27 ||
      target.classList.contains('modal-t_active') ||
      target.classList.contains('modal-t-thanks__close')) {
        modal.classList.remove('modal_active');
        modalThanks.classList.remove('modal-t_active');
    }
    modal.removeEventListener('click', closeModal);
    document.removeEventListener('keydown', closeModal);
  };

  const sendMail = (event) => {
    event.preventDefault();
    let sendedOrder = whatOrder.dataset.whatOrder;
    let username = form[0].value;
    let email = form[1].value;
    let phone = form[2].value;
    let comment = form[3].value;
    formData.append('sendedOrder', sendedOrder);
    formData.append('username', username);
    formData.append('email', email);
    formData.append('phone', phone);
    formData.append('comment', comment);

    fetch("php/mail.php", {
      method: "POST",
      body: formData
    });
    // .then(response => response.text())
    // .then(response => console.log(response));

    modal.classList.remove('modal_active');
    modalThanks.classList.add('modal-t_active');
    modalThanks.addEventListener('click', closeModal);
  };

  const musicRemote = () => {
    video.muted = (video.muted == false) ? true : false;
    volume.classList.toggle('main-header__music-button_mute');
  };

  btnRent.addEventListener('click', openModal);
  playWithUs.addEventListener('click', openModal);
  playWithYou.addEventListener('click', openModal);
  catering.addEventListener('click', openModal);
  btnCloseModal.addEventListener('click', closeModal);
  form.addEventListener('submit', sendMail);
  volume.addEventListener('click', musicRemote);
});