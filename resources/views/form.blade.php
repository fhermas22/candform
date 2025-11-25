<x-app>

    <main class="flex-1">
      <section class="max-w-4xl mx-auto px-6 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-xl p-8">
          <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Formulaire de candidature</h1>
          <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
            Merci d'indiquer vos informations. Un e‑mail de confirmation vous sera envoyé après soumission.
          </p>

          @if(session('success'))
            <div class="mt-4 p-3 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-800">
              {{ session('success') }}
            </div>
          @endif

          @if ($errors->any())
            <div class="mt-4 p-3 rounded-md bg-rose-50 border border-rose-200 text-rose-800">
              <ul class="text-sm space-y-1">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form id="candidature-form" action="/form" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="last_name" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Nom</label>
                <input required type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="mt-1 block w-full rounded-md border border-slate-200 bg-white dark:bg-slate-700 px-3 py-2 text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-rose-500" />
              </div>

              <div>
                <label for="first_name" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Prénom</label>
                <input required type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="mt-1 block w-full rounded-md border border-slate-200 bg-white dark:bg-slate-700 px-3 py-2 text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-rose-500" />
              </div>
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Email</label>
              <input required type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border border-slate-200 bg-white dark:bg-slate-700 px-3 py-2 text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-rose-500" />
            </div>

            <div>
              <label for="address" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Adresse</label>
              <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border border-slate-200 bg-white dark:bg-slate-700 px-3 py-2 text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-rose-500">{{ old('address') }}</textarea>
            </div>

            <div>
              <label for="poste" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Poste visé</label>
              <select name="poste" id="poste" required class="mt-1 block w-full rounded-md border border-slate-200 bg-white dark:bg-slate-700 px-3 py-2 text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-rose-500">
                <option value="">Sélectionnez un poste</option>
                <option value="developpeur_web" {{ old('poste')=='developpeur_web' ? 'selected' : '' }}>Développeur Web</option>
                <option value="developpeur_mobile" {{ old('poste')=='developpeur_mobile' ? 'selected' : '' }}>Développeur Mobile</option>
                <option value="data_scientist" {{ old('poste')=='data_scientist' ? 'selected' : '' }}>Data Scientist</option>
                <option value="product_manager" {{ old('poste')=='product_manager' ? 'selected' : '' }}>Product Manager</option>
                <option value="designer" {{ old('poste')=='designer' ? 'selected' : '' }}>Designer</option>
              </select>
            </div>

            <div>
              <label for="cv" class="block text-sm font-medium text-slate-700 dark:text-slate-200">CV (PDF, max 10 MB)</label>
              <div class="mt-1 flex items-center gap-4">
                <input required type="file" name="cv" id="cv" accept="application/pdf" class="block w-full text-sm text-slate-700 dark:text-slate-200 file:mr-4 file:rounded-md file:border-0 file:bg-rose-600 file:px-3 file:py-2 file:text-white" />
              </div>
              <p id="cvHelp" class="mt-2 text-xs text-slate-500 dark:text-slate-400">Seuls les fichiers PDF sont acceptés. Taille maximale : 10 Mo.</p>
              <p id="cvError" class="mt-2 text-sm text-rose-600 hidden"></p>
            </div>

            <div class="flex items-center justify-between gap-4">
              <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white rounded-md shadow">
                Soumettre la candidature
              </button>

              <a href="{{ url('/') }}" class="text-sm text-slate-600 hover:underline">Retour à l'accueil</a>
            </div>
          </form>
        </div>
      </section>
    </main>

    <script>
      (function () {
        const cvInput = document.getElementById('cv');
        const cvError = document.getElementById('cvError');
        const form = document.getElementById('candidature-form');

        function formatBytes(bytes) {
          if (bytes === 0) return '0 Bytes';
          const k = 1024, dm = 2;
          const sizes = ['Bytes', 'KB', 'MB', 'GB'];
          const i = Math.floor(Math.log(bytes) / Math.log(k));
          return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }

        cvInput.addEventListener('change', function () {
          cvError.classList.add('hidden');
          cvError.textContent = '';

          const file = this.files[0];
          if (!file) return;

          // Verify the MIME type (client side)
          if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
            cvError.textContent = 'Le fichier doit être au format PDF.';
            cvError.classList.remove('hidden');
            this.value = '';
            return;
          }

          // Verify the size (10 MB)
          const maxBytes = 10 * 1024 * 1024;
          if (file.size > maxBytes) {
            cvError.textContent = 'Fichier trop volumineux (' + formatBytes(file.size) + '). Taille maximale : 10 Mo.';
            cvError.classList.remove('hidden');
            this.value = '';
            return;
          }
        });

        form.addEventListener('submit', function (e) {
          // Last verification before sending
          const file = cvInput.files[0];
          if (!file) {
            e.preventDefault();
            cvError.textContent = 'Veuillez joindre votre CV en PDF.';
            cvError.classList.remove('hidden');
            return;
          }
        });
      })();
    </script>

</x-app>
