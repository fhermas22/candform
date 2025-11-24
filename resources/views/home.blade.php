<x-app>

    <main class="flex-1">
        <section class="max-w-6xl mx-auto px-6 py-16 lg:py-24 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white leading-tight">
                    Simplifiez vos candidatures — Rapide, sécurisé et professionnel
                </h1>
                <p class="text-slate-600 dark:text-slate-300 max-w-xl">
                    CandForm vous permet de soumettre votre candidature en quelques minutes. Remplissez le formulaire, recevez une confirmation immédiate et un e‑mail récapitulatif.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/form" class="inline-flex items-center justify-center px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white rounded-md shadow">
                        Postuler maintenant
                    </a>
                    <a href="#features" class="inline-flex items-center justify-center px-6 py-3 border border-slate-200 rounded-md text-slate-700 hover:bg-slate-50">
                        En savoir plus
                    </a>
                </div>

                <div class="mt-4 text-sm text-slate-500 dark:text-slate-400">
                    Besoin d'aide ? Contactez l'administrateur du site ou consultez la documentation.
                </div>
            </div>

            <div class="order-first lg:order-last flex items-center justify-center">
                <div class="w-full max-w-md p-6 bg-white shadow-lg rounded-xl dark:bg-slate-800">
                    <h3 class="text-lg font-semibold text-slate-800 dark:text-white">Aperçu du formulaire</h3>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                        Capturez les informations essentielles : identité, contact et CV . Une notification et un e‑mail sont envoyés automatiquement après soumission.
                    </p>

                    <ul id="features" class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-300">
                        <li>✓ Confirmation visuelle immédiate</li>
                        <li>✓ Email de confirmation</li>
                        <li>✓ Stockage sécurisé des données</li>
                    </ul>

                    <div class="mt-6">
                        <a href="/form" class="w-full inline-block text-center px-4 py-2 bg-slate-900 text-white rounded-md hover:opacity-95">
                            Ouvrir le formulaire
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-slate-50 dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800">
            <div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h4 class="font-semibold text-slate-900 dark:text-white">Rapide</h4>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-2">Formulaire optimisé pour aller à l'essentiel.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900 dark:text-white">Fiable</h4>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-2">Notifications et mails envoyés automatiquement.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900 dark:text-white">Sécurisé</h4>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-2">Données traitées conformément aux bonnes pratiques.</p>
                </div>
            </div>
        </section>
    </main>

</x-app>
