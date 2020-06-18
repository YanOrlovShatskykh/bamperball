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

  
  
  

  
  
  


  const openModal = event => {
    event.preventDefault();
    const target = event.target;

    modal.classList.add('modal_active');

    modal.addEventListener('click', closeModal);
    document.addEventListener('keydown', closeModal);

    let order = target.dataset.order;

    
    whatOrder.dataset.whatOrder = order;
    
    // console.log(whatOrder.dataset.whatOrder);
    
  };


  const closeModal = event => {
    // event.preventDefault();
    const target = event.target;
    console.log(true);

    if(target.classList.contains('modal_active') ||
      target.classList.contains('modal-dialog__close') ||
      event.keyCode == 27 ||
      target.classList.contains('modal-t_active') ||
      target.classList.contains('modal-t-thanks__close')) {
        
        modal.classList.remove('modal_active');
        modalThanks.classList.remove('modal-t_active');
    }


  };

  // document.addEventListener('click', event => {
  //   console.log(event.target);
    
  // });


  const formData = new FormData();

  const sendMail = (event) => {
    event.preventDefault();

    let sendedOrder = whatOrder.dataset.whatOrder;
    let username = form[0].value;
    let email = form[1].value;
    let phone = form[2].value;
    let comment = form[3].value;



    // console.log(sendedOrder, username, email, phone, comment);
          
    formData.append('sendedOrder', sendedOrder);
    formData.append('username', username);
    formData.append('email', email);
    formData.append('phone', phone);
    formData.append('comment', comment);


    // console.dir(formData);
    
    fetch("php/mail.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.text())
    .then(response => console.log(response));

    modal.classList.remove('modal_active');
    modalThanks.classList.add('modal-t_active');

    modalThanks.addEventListener('click', closeModal);

    
  };

  // console.dir(form);
  

  btnRent.addEventListener('click', openModal);
  playWithUs.addEventListener('click', openModal);
  playWithYou.addEventListener('click', openModal);
  catering.addEventListener('click', openModal);
  btnCloseModal.addEventListener('click', closeModal);
  
  // sendBtn.addEventListener('click', sendMail);
  form.addEventListener('submit', sendMail);
  
});