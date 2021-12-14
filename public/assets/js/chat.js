

let chatDiv = document.querySelector('.overflow-auto');
chatDiv.scrollTop = chatDiv.scrollHeight; 

let chatForm = $('#chat-form');
function handleForm(event) {
    event.preventDefault(); // Empêche la page de se rafraîchir après le submit du formulaire
}

chatForm.on('submit', handleForm);

const submit = document.querySelector('button');
submit.onclick = e => { // On change le comportement du submit
    const message = document.getElementById('message'); // Récupération du message dans l'input correspondant
    const channelId = $('.channel-id').data('channel-id');
    console.log(channelId);
    const data = { // La variable data sera envoyée au controller
        'content': message.value, // On transmet le message...
        'channel': channelId
    }

    console.log(data); // Pour vérifier vos informations
    // fetch('/message', { // On envoie avec un post nos datas sur le endpoint /message de notre application
    //     method: 'POST',
    //     body: JSON.stringify(data) // On envoie les data sous format JSON
    // }).then((response) => {
    //     message.value = '';
    //     console.log(response);
    // });

    $.ajax(
        {
            url: Routing.generate("send-message"),
            method: "POST",
            data: JSON.stringify(data)
        }).done(function (response) {
            e.preventDefault();
            if (null !== response) {
                message.value = "";
                console.log(response)
    
            } else {
                console.log('Problème');
            }
        }).fail(function (jqXHR, textStatus, error) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(error);
        });
}