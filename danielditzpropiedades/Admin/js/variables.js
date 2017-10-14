
    window.base_url = "../../ws/development/api.php";
    window.upload_url = "../../ws/development/uploadFiles.php/uploadFiles";

    /** Sesion globals variables**/
    window.profileEmail=undefined;
    window.profileImage="images/default-profile.png";
    window.profileName=undefined;
    window.profileLastName=undefined;
    window.profileID=null;

    /** WS sesion **/
    window.ws_login="/user/signin";
    window.USER_TOKEN="USER_TOKEN";
    window.ws_user_profile="/user/profile";
    window.ws_user_changepass="/user/changePassword";
    window.ws_user_profile_edit="/user/profile/edit";

    /** WS Persona **/
    window.ws_personas="/personas";
    window.ws_persona_isRegister="/persona/isRegister";
    window.ws_persona_get="/persona/getByID";
    window.ws_persona_add="/persona/add";
    window.ws_persona_edit="/persona/edit";
    window.ws_persona_remove="/persona/remove";

    /** WS Direccion **/
    window.ws_address_getAll="/address/getAll";
    window.ws_address_input_getAll="/address/Inputs/getAll";
    window.ws_address_exists="/address/exist";

    /** WS Inmuebles **/
    window.ws_inmueble_isRegister="/inmobiliaria/inmueble/isRegister";
    window.ws_inmueble_get="/inmobiliaria/inmueble/getByID";

    /** WS Alquileres Disponibles **/
    window.ws_alquileres_disponibles="/alquileres/alquileresDisponibles";
    window.ws_alquiler_disponible_get="/alquileres/alquilerDisponibleByID";
    window.ws_alquiler_disponible_add="/alquileres/alquileresDisponibles/add";
    window.ws_alquiler_disponible_edit="/alquileres/alquileresDisponibles/edit";
    window.ws_alquiler_disponible_remove="/alquileres/alquileresDisponibles/remove";
    window.ws_alquiler_disponible_contrato="/alquileres/alquileresDisponibles/contrato";

    /** WS Alquileres Contrato **/
    window.ws_alquileres_contrato="/alquileres/alquileresContrato";
    window.ws_alquiler_contrato_get="/alquileres/alquilerContratoByID";
    window.ws_alquiler_contrato_add="/alquileres/alquileresContrato/add";
    window.ws_alquiler_contrato_edit="/alquileres/alquileresContrato/edit";
    window.ws_alquiler_contrato_remove="/alquileres/alquileresContrato/remove";








