// app.js - CustomAlert para el modal de "Volver a ingresar"
// Uso: Alert.render()  o Alert.render('index.html');
// Requiere en el HTML elementos con id="popUpBox", id="popUpOverlay" y id="closeModal"

function CustomAlert(){
  // handlers guardados para poder removerlos
  this._overlayHandler = null;
  this._escHandler = null;

  // Abre el modal. redirectUrl es opcional (por defecto 'index.html')
  this.render = function(redirectUrl = 'index.html', yesText = '¡Sí quiero!', noText = 'No, cancelar') {
    const popUpBox = document.getElementById('popUpBox');
    const popUpOverlay = document.getElementById('popUpOverlay');
    const closeModal = document.getElementById('closeModal');

    if (!popUpBox || !popUpOverlay || !closeModal) {
      console.warn('CustomAlert: faltan elementos #popUpBox, #popUpOverlay o #closeModal en el DOM.');
      return;
    }

    // Mostrar overlay y caja
    popUpOverlay.style.display = 'block';
    popUpBox.style.display = 'block';

    // Inyectar botones (link a redirectUrl + botón cancelar)
    // Usamos atributos y event listeners separados para evitar HTML inline con comportamiento
    closeModal.innerHTML = ''; // limpiar

    // Crear enlace + botón "Sí"
    const link = document.createElement('a');
    link.href = redirectUrl;
    const yesBtn = document.createElement('button');
    yesBtn.type = 'button';
    yesBtn.id = 'yesBtn';
    yesBtn.textContent = yesText;
    yesBtn.style.marginRight = '8px';
    // puedes estilizar con clases en vez de estilos inline
    link.appendChild(yesBtn);
    closeModal.appendChild(link);

    // Botón "No" (cierra modal)
    const noBtn = document.createElement('button');
    noBtn.type = 'button';
    noBtn.id = 'noBtn';
    noBtn.textContent = noText;
    closeModal.appendChild(noBtn);

    // Asociar evento al botón No
    noBtn.addEventListener('click', () => { this.ok(); });

    // Cerrar al hacer click fuera del modal (en el overlay)
    // Guardamos el handler para poder removerlo después
    this._overlayHandler = (e) => {
      if (e.target === popUpOverlay) this.ok();
    };
    popUpOverlay.addEventListener('click', this._overlayHandler);

    // Cerrar con la tecla Escape
    this._escHandler = (e) => {
      if (e.key === 'Escape' || e.key === 'Esc') this.ok();
    };
    document.addEventListener('keydown', this._escHandler);
  };

  // Cierra el modal y limpia listeners
  this.ok = function(){
    const popUpBox = document.getElementById('popUpBox');
    const popUpOverlay = document.getElementById('popUpOverlay');
    const closeModal = document.getElementById('closeModal');

    if (popUpBox) popUpBox.style.display = 'none';
    if (popUpOverlay) popUpOverlay.style.display = 'none';

    // remover listeners si existen
    if (this._overlayHandler && popUpOverlay) {
      popUpOverlay.removeEventListener('click', this._overlayHandler);
      this._overlayHandler = null;
    }
    if (this._escHandler) {
      document.removeEventListener('keydown', this._escHandler);
      this._escHandler = null;
    }

    // opcional: limpiar el contenido del closeModal
    if (closeModal) closeModal.innerHTML = '';
  };
}

// Instancia global para usar desde el HTML: onclick="Alert.render()"
var Alert = new CustomAlert();