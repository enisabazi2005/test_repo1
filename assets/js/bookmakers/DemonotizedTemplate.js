export default function DemonotizedTemplate() 
{
    const btns = document.querySelectorAll('.openModalBtn');
    let bookmakerModal = document.getElementById("bookmaker-modal");

    btns.forEach(btn => {
        btn.addEventListener('click', () => {
            bookmakerModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    });
  
    document.getElementById('closeModalBtn')?.addEventListener('click', () => {
        bookmakerModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    // bookmakerModal?.addEventListener('click', ()=>{
    //     console.log('test');
    //     if(bookmakerModal.style.display === 'block'){
    //         bookmakerModal.style.display = 'none';
    //         document.body.style.overflow = 'auto';
    //     }
    // })
}