var done_btn = document.getElementById("r_p_done_btn");
var form_modal = document.getElementById("default_modal");
var loading_modal = document.getElementById("loading");
var success_modal = document.getElementById("r_p_modal");
let set_time_id = null;
const content = document.getElementsByName("cont");
const language = document.getElementsByName("lang");
const twitter = document.getElementsByName("twitter");


//record_post_modal
function loading() {
    form_modal.style.display = "none";
    loading_modal.style.display = "flex";
    // r_p_loading.style.visibility="visible";
    set_time_id = setTimeout(success, 3000);
};

function success() {
    loading_modal.style.display = "none";
    success_modal.style.display = "block";

    //twitterに関する処理
    const txt_twitter = document.getElementById("twitter_comment").value;
    if (twitter[0].checked) window.open("https://twitter.com/intent/tweet?text=" + txt_twitter);

};

var inner = document.getElementById("modal_inner")

const modalArea = document.getElementById('modalArea');
const openModal = document.getElementById('openModal');
const openModal_s = document.getElementById('openModal-s');
const closeModal = document.getElementById('closeModal');
const modalBg = document.getElementById('modalBg');
const modalParts = [openModal, openModal_s, closeModal, modalBg]; // これはArray

//↓モーダルを表示するスクリプト↓

// for(let i=0, len=modalParts.length ; i<len ; i++){
//   modalParts[i].addEventListener('click',function(){
//     if(!modalArea.classList.contains('is-show')){
//       modalArea.classList.add('is-show');
//       bodyScrollPrevent(true); //スクロール制御関数
//     } else {
//       modalArea.classList.remove('is-show');
//       bodyScrollPrevent(false,modalArea); //スクロール制御関数
//       form_modal.style.display="block";
//       loading_modal.style.display="none";
//       success_modal.style.display="none";
//       if(set_time_id!==null) clearTimeout(set_time_id);
//       set_time_id=null;
//     }
//   });
// }

// console.log('hoge', document.getElementsByClassName("fas")) // x: Array, ○: HTMLCollection
// ArrayはforEachを使える、HTMLCollectionはforEachを使えない
// HTMLCollectionをArrayにしたい -> Array.from(HTMLCollection)でArrayにしてあげる
Array.from(modalParts).forEach((modal) => {
    modal.addEventListener('click', function () {
        if (!modalArea.classList.contains('is-show')) {
            modalArea.classList.add('is-show');
            bodyScrollPrevent(true); //スクロール制御関数
        } else {
            modalArea.classList.remove('is-show');
            bodyScrollPrevent(false, modalArea); //スクロール制御関数
            form_modal.style.display = "block";
            loading_modal.style.display = "none";
            success_modal.style.display = "none";
            if (set_time_id !== null) clearTimeout(set_time_id);
            set_time_id = null;
            twitter[0].checked = false;
            for (let i = 0; i < 3; i++) content[i].checked = false;
            for (let i = 0; i < 8; i++) language[i].checked = false;
            document.getElementById("twitter_comment").value = '';
        }
    });
})

//↓スクロール制御のための関数↓
function bodyScrollPrevent(flag, modal) {
    let scrollPosition;
    const body = document.getElementsByTagName('body')[0];
    const ua = window.navigator.userAgent.toLowerCase();
    const isiOS = ua.indexOf('iphone') > -1 || ua.indexOf('ipad') > -1 || ua.indexOf('macintosh') > -1 && 'ontouchend' in document;
    const scrollBarWidth = window.innerWidth - document.body.clientWidth;
    if (flag) {
        body.style.paddingRight = scrollBarWidth + 'px';
        if (isiOS) {
            scrollPosition = -window.pageYOffset;
            body.style.position = 'fixed';
            body.style.width = '100%';
            body.style.top = scrollPosition + 'px';
        } else {
            body.style.overflow = 'hidden';
        }
    } else if (!flag) {
        addEventListenerOnce(modal, 'transitionend', function () {
            body.style.paddingRight = '';
            if (isiOS) {
                scrollPosition = parseInt(body.style.top.replace(/[^0-9]/g, ''));
                body.style.position = '';
                body.style.width = '';
                body.style.top = '';
                window.scrollTo(0, scrollPosition);
            } else {
                body.style.overflow = '';
            }
        });
    }

    function addEventListenerOnce(node, event, callback) {
        const handler = function (e) {
            callback.call(this, e);
            node.removeEventListener(event, handler);
        };
        node.addEventListener(event, handler);
    }
}
