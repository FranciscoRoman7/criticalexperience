        // Almacenar el estado actual en localStorage al hacer click en los botones para que recuerde en que apartado se encuentra el usuario.

        $('.btn-enregistrer').click(function() {
          localStorage.setItem('activeSection', 'enregistrer');
          $('.connexion').addClass('remove-section');
          $('.enregistrer').removeClass('active-section');
          $('.btn-enregistrer').removeClass('active');
          $('.btn-connexion').addClass('active');
      });

      $('.btn-connexion').click(function() {
          localStorage.setItem('activeSection', 'connexion');
          $('.connexion').removeClass('remove-section');
          $('.enregistrer').addClass('active-section');	
          $('.btn-enregistrer').addClass('active');
          $('.btn-connexion').removeClass('active');
      });

      $(document).ready(function() {
          var activeSection = localStorage.getItem('activeSection');
          if (activeSection === 'enregistrer') {
              $('.connexion').addClass('remove-section');
              $('.enregistrer').removeClass('active-section');
              $('.btn-enregistrer').removeClass('active');
              $('.btn-connexion').addClass('active');
          } else {
              $('.connexion').removeClass('remove-section');
              $('.enregistrer').addClass('active-section');
              $('.btn-enregistrer').addClass('active');
              $('.btn-connexion').removeClass('active');
          }
      });