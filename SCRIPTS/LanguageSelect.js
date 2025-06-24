function changeLanguage() {
    var selectedLanguage = document.getElementById('languageSelection').value; //creates a variable for the text in the element language selection
    var titleElement = document.getElementById('title');
    var labelElement = document.getElementById('languageLabel');
    var buttonElement = document.getElementById('changeLanguage');
    var navHomeElement = document.getElementById("homenav");
    var navStockElement = document.getElementById("stocknav");
    var navCustomerElement = document.getElementById("customernav");
    var navOrderElement = document.getElementById("ordernav");
    var navProfileElement = document.getElementById("profilenav");
    var navAdminElement = document.getElementById("adminnav");
    var navSettingElement = document.getElementById("settingnav");
    var navLogoutElement = document.getElementById("logoutnav");
    var hometitleElement = document.getElementById('hometitle');
    var instructionsElement = document.getElementById('instructions');
    var list1Element = document.getElementById("list1");
    var list2Element = document.getElementById("list2");
    var list3Element = document.getElementById("list3");
    var list4Element = document.getElementById("list4");
    var list5Element = document.getElementById("list5");
    var list6Element = document.getElementById("list6");
    var list7Element = document.getElementById("list7");
    var list8Element = document.getElementById("list8");

    switch (selectedLanguage) {
        case 'en': //in english
            titleElement.innerText = "92DK Stock Management";
            labelElement.innerText = 'Select Language';
            buttonElement.innerText = 'Change Language';
            navHomeElement.innerText = 'Home';
            navStockElement.innerText = 'Stocks';
            navCustomerElement.innerText = 'Customers';
            navOrderElement.innerText = 'Orders';
            navProfileElement.innerText = 'Profile';
            navAdminElement.innerText = 'Admin';
            navSettingElement.innerText = 'Settings';
            navLogoutElement.innerText = 'Logout';
            hometitleElement.innerText = "Home Page";
            instructionsElement.innerText = 'Welcome to the 92 Donner Kings Stock management system! Select the page you want to view from the navigation bar at the top:';
            list1Element.innerText = 'Home: Where you are right now.';
            list2Element.innerText = 'Stocks: View the stocks currently available and their suppliers. [admins can modify them].';
            list3Element.innerText = 'Customers: View the customers currently in the system.';
            list4Element.innerText = 'Orders: View & add orders to the system.';
            list5Element.innerText = 'Profile: View your user profile, and change your username/passoword.';
            list6Element.innerText = 'Admin: ADMINS ONLY. View all user and business location data and add/remove instances of both.';
            list7Element.innerText = 'Settings: Bring up the settings pannel where you can change the page language.';
            list8Element.innerText = 'Logout: Log out of the system.';
            break;
        case 'fr': //in french
            titleElement.innerText = "Gestion des stocks 92DK";
            labelElement.innerText = 'Choisir la langue'; 
            buttonElement.innerText = 'Changer de langue'; 
            navHomeElement.innerText = 'Maison';
            navStockElement.innerText = 'Stocks';
            navCustomerElement.innerText = 'Clients';
            navOrderElement.innerText = 'Commandes';
            navProfileElement.innerText = 'Profil';
            navAdminElement.innerText = 'Administrateur';
            navSettingElement.innerText = 'Paramètres';
            navLogoutElement.innerText = 'Déconnexion';
            hometitleElement.innerText = "Page d'accueil";
            instructionsElement.innerText = 'Bienvenue dans le système de gestion des stocks de 92 Donner Kings ! Sélectionnez la page que vous souhaitez afficher dans la barre de navigation en haut:';
            list1Element.innerText = 'Domicile: où vous vous trouvez actuellement.';
            list2Element.innerText = 'Stocks: Consultez les stocks actuellement disponibles et leurs fournisseurs. [les administrateurs peuvent les modifier].';
            list3Element.innerText = 'Clients: affichez les clients actuellement dans le système.';
            list4Element.innerText = 'Commandes: affichez et ajoutez des commandes au système.';
            list5Element.innerText = 'Profil: affichez votre profil utilisateur et modifiez votre nom d`utilisateur/mot de passe.';
            list6Element.innerText = 'Administrateur : ADMINISTES UNIQUEMENT. Affichez toutes les données d`emplacement des utilisateurs et de l`entreprise et ajoutez/supprimez des instances des deux.';
            list7Element.innerText = 'Paramètres: affichez le panneau de paramètres dans lequel vous pouvez modifier la langue de la page.';
            list8Element.innerText = 'Déconnexion: déconnectez-vous du système.';
            break;
        case 'pl': //in polish
            titleElement.innerText = "Zarządzanie zapasami 92DK";
            labelElement.innerText = 'Wybierz Język';
            buttonElement.innerText = 'Zmień Język';
            navHomeElement.innerText = 'Strona główna';
            navStockElement.innerText = 'Zapasy';
            navCustomerElement.innerText = 'Klienci';
            navOrderElement.innerText = 'Zamówienia';
            navProfileElement.innerText = 'Profil';
            navAdminElement.innerText = 'Administrator';
            navSettingElement.innerText = 'Ustawienia';
            navLogoutElement.innerText = 'Wyloguj';
            hometitleElement.innerText = "Strona główna";
            instructionsElement.innerText = 'Witamy w systemie zarządzania zapasami 92 Donner Kings! Z paska nawigacyjnego u góry wybierz stronę, którą chcesz wyświetlić:';
            list1Element.innerText = 'Strona główna: gdzie teraz jesteś.';
            list2Element.innerText = 'Zapasy: Wyświetl aktualnie dostępne zapasy i ich dostawców. [administratorzy mogą je modyfikować].';
            list3Element.innerText = 'Klienci: Wyświetl klientów aktualnie znajdujących się w systemie [administratorzy mogą ich modyfikować].';
            list4Element.innerText = 'Zamówienia: przeglądaj i dodawaj zamówienia do systemu.';
            list5Element.innerText = 'Profil: Wyświetl swój profil użytkownika i zmień nazwę użytkownika/hasło.';
            list6Element.innerText = 'Administrator: TYLKO ADMINI. Przeglądaj wszystkie dane o lokalizacji użytkowników i firm oraz dodawaj/usuwaj ich wystąpienia.';
            list7Element.innerText = 'Ustawienia: Wyświetl panel ustawień, w którym możesz zmienić język strony.';
            list8Element.innerText = 'Wyloguj się: Wyloguj się z systemu.';
            break;

        default: //default text if no language is selected
            titleElement.innerText = "92DK Stock Management";
            labelElement.innerText = 'Select Language';
            buttonElement.innerText = 'Change Language';
            navHomeElement.innerText = 'Home';
            navStockElement.innerText = 'Stocks';
            navCustomerElement.innerText = 'Customers';
            navOrderElement.innerText = 'Orders';
            navProfileElement.innerText = 'Profile';
            navAdminElement.innerText = 'Admin';
            navSettingElement.innerText = 'Settings';
            navLogoutElement.innerText = 'Logout';
            hometitleElement.innerText = "Home Page";
            instructionsElement.innerText = 'Welcome to the 92 Donner Kings Stock management system! Select the page you want to view from the navigation bar at the top:';
            list1Element.innerText = 'Home: Where you are right now.';
            list2Element.innerText = 'Stocks: View the stocks currently available and their suppliers. [admins can modify them].';
            list3Element.innerText = 'View the customers currently in the system.';
            list4Element.innerText = 'Orders: View & add orders to the system.';
            list5Element.innerText = 'Profile: View your user profile, and change your username/passoword.';
            list6Element.innerText = 'Admin: ADMINS ONLY. View all user and business location data and add/remove instances of both.';
            list7Element.innerText = 'Settings: Bring up the settings pannel where you can change the page language.';
            list8Element.innerText = 'Logout: Log out of the system.';
    }
}