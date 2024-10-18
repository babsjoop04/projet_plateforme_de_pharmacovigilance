import { Facebook, Github, Instagram, LogOut, Twitter } from "lucide-react";

import { Button } from "@/components/ui/button";
import Header from "../components/Header";

import homme_1 from "../assets/homme_1.jpg";
import homme_2 from "../assets/homme_2.jpg";
import homme_3 from "../assets/homme_3.jpg";

import femme_1 from "../assets/femme_1.jpg";
import femme_2 from "../assets/femme_2.jpg";
import femme_3 from "../assets/femme_3.jpg";


import imgMedicament from "../assets/securite.jpg";
import {
  ArrowBigRightDash,
  BookOpen,
  FileChartColumnIncreasing,
  MoonStar,
  Power,
} from "lucide-react";
import Footer from "../components/Footer";

const LandingPage = () => {
    return (
        <>
      <Header />
      {/* border-2 border-solid border-red-700 */}

      <div class="relative z-20 flex items-center overflow-hidden bg-white dark:bg-gray-800">
        <div class="container relative flex px-6 py-16 mx-auto">
          <div class="relative   z-20 flex flex-col sm:w-2/3 lg:w-3/5">
            {/* <span class="w-20 h-2 mb-12 bg-gray-800 dark:bg-white">
            </span> */}
            <h1 class="flex flex-col text-2xl font-black leading-none text-indigo-500 uppercase font-bebas-neue sm:text-8xl dark:text-white">
              Contribuons
            </h1>
            <span class="text-sm font-semibold sm:text-7xl">
              à l’utilisation sécurisée des produits de santé
            </span>
            <p class="text-sm mt-5 text-gray-700 sm:text-base dark:text-white">
              Protégeons ensemble la santé de tous. Notre plateforme de
              pharmacovigilance est au cœur de la sécurité des médicaments,
              veillant sans relâche sur votre bien-être. Grace à cette
              plateforme , nous contribuons à rendre les traitements plus sûrs
              jour après jour. Rejoignez-nous dans cette mission cruciale .
              Ensemble, façonnons un avenir où chaque médicament est synonyme de
              confiance et de sécurité.
            </p>
            <div class="flex mt-8">
              <Button className="px-4 mx-1 py-2 bg-indigo-500 hover:bg-indigo-600 text-gray-50 rounded-xl flex items-center gap-2">
                <Power />
                <span>Commencer</span>
              </Button>
            </div>
          </div>
          <div class="relative flex-initial hidden  py-5  w-32 sm:block sm:w-1/3 lg:w-2/5">
            <img src={imgMedicament} class=" max-w-xs  m-auto md:max-w-sm" />
          </div>
        </div>
      </div>

      {/* <!-- presentation des fonctionnalites --> */}
      <section class="bg-gray-100 dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
          <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">
            Explorer <br /> nos{" "}
            <span class="underline decoration-blue-500">Fonctionnalités</span>
          </h1>

          <p class="mt-4 text-gray-500 xl:mt-6 dark:text-gray-300">
            Découvrez comment notre plateforme innovante simplifie et renforce
            la pharmacovigilance grâce à ses fonctionnalités clés
          </p>

          <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-2 xl:grid-cols-3">
            <div class="p-8 space-y-3 border-2 border-indigo-500 dark:border-blue-300 rounded-xl">
              <span class="inline-block text-blue-500 dark:text-blue-400">
                <FileChartColumnIncreasing />
              </span>

              <h1 class="text-2xl font-semibold text-gray-700 capitalize dark:text-white">
                Notification
              </h1>

              <p class="text-gray-500 dark:text-gray-300">
                Notre plateforme révolutionne la déclaration des événements
                indésirables en intégrant les notifications Manifestations
                Post-Vaccinale Indersirables (MAPI), évenements/effets
                indésirables des Médicaments (EEIM) et Produits de Qualité
                Inférieurs et falsifiés (PQIF). Grâce à des formulaires
                intuitifs et adaptés à chaque type de déclaration, vous
                contribuez efficacement à l'amélioration continue de la sécurité
                des produits de santé. Notre système centralise et analyse ces
                données précieuses, permettant une détection précoce des risques
                et une réponse rapide des autorités sanitaires.
              </p>
              <ArrowBigRightDash />
            </div>

            <div class="p-8 space-y-3 border-2 border-indigo-500 dark:border-blue-300 rounded-xl">
              <span class="inline-block text-blue-500 dark:text-blue-400">
                <BookOpen />
              </span>

              <h1 class="text-2xl font-semibold text-gray-700 capitalize dark:text-white">
                Informations sur les produits de santé
              </h1>

              <p class="text-gray-500 dark:text-gray-300">
                Notre plateforme offre un accès rapide et complet aux
                informations essentielles sur les produits de santé. Vous pouvez
                instantanément consulter les données à jour sur les médicaments,
                vaccins et dispositifs médicaux. Que vous cherchiez des
                indications thérapeutiques, des effets secondaires connus, des
                interactions médicamenteuses ou les dernières alertes de
                sécurité, notre base de données exhaustive répond à vos besoins.
                Cette fonctionnalité renforce la sécurité des traitements en
                mettant l'information cruciale à portée de main, contribuant
                ainsi à une utilisation plus sûre et efficace des produits de
                santé.
              </p>

              <ArrowBigRightDash />
            </div>

            <div class="p-8 space-y-3 border-2 border-indigo-500 dark:border-blue-300 rounded-xl">
              <span class="inline-block text-blue-500 dark:text-blue-400">
                <MoonStar />
              </span>

              <h1 class="text-2xl font-semibold text-gray-700 capitalize dark:text-white">
                Simple & clean designs
              </h1>

              <p class="text-gray-500 dark:text-gray-300">
                Notre plateforme se distingue par son design épuré et son
                interface intuitive, conçus pour simplifier la
                pharmacovigilance. Chaque élément est soigneusement pensé pour
                offrir une expérience utilisateur fluide et sans distraction.
                Des formulaires clairs aux tableaux de bord visuellement
                attrayants, notre design minimaliste permet une navigation aisée
                et une compréhension rapide des informations critiques. Cette
                approche "Simple & clean" augmente l'efficacité et minimise les
                erreurs, permettant aux professionnels de santé de se concentrer
                sur l'essentiel : la sécurité des patients.
              </p>

              <ArrowBigRightDash />
            </div>
          </div>
        </div>
      </section>

      <section className="py-6 dark:bg-gray-100 dark:text-gray-800">
        <div className="container p-4 mx-auto space-y-16 sm:p-10">
          <div className="space-y-4">
            <h3 className="text-2xl font-bold leading-none sm:text-5xl">
              Rencontrez notre equipe
            </h3>
            <p className="max-w-2xl dark:text-gray-600">
              At a assumenda quas cum earum ut itaque commodi saepe rem
              aspernatur quam natus quis nihil quod, hic explicabo doloribus
              magnam neque, exercitationem eius sunt!
            </p>
          </div>
          <div className="grid w-full grid-cols-1 gap-6 md:grid-cols-2">
            <div className="flex space-x-6">
              <img
                alt=""
                className="flex-1 flex-shrink-0 object-cover h-56 mb-4 bg-center rounded-sm dark:bg-gray-500"
                src={homme_1}
              />
              <div className="flex flex-col">
                <h4 className="text-xl font-semibold">Leroy Jenkins</h4>
                <p className="text-sm dark:text-gray-600">Web developer</p>
                <div className="flex mt-2 space-x-2">
                  <ul className="mt-12 flex flex-wrap justify-center gap-2 ">
                    <li>
                      <Facebook />
                    </li>

                    <li>
                      <Instagram />
                    </li>

                    <li>
                      <Twitter />
                    </li>

                    <li>
                      <Github />
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="flex space-x-6">
              <img
                alt=""
                className="flex-1 flex-shrink-0 object-cover h-56 mb-4 bg-center rounded-sm dark:bg-gray-500"
                src={homme_2}
              />
              <div className="flex flex-col">
                <h4 className="text-xl font-semibold">Leroy Jenkins</h4>
                <p className="text-sm dark:text-gray-600">Web developer</p>
                <div className="flex mt-2 space-x-2">
                  <ul className="mt-12 flex flex-wrap justify-center gap-2 ">
                    <li>
                      <Facebook />
                    </li>

                    <li>
                      <Instagram />
                    </li>

                    <li>
                      <Twitter />
                    </li>

                    <li>
                      <Github />
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="flex space-x-6">
              <img
                alt=""
                className="flex-1 flex-shrink-0 object-cover h-56 mb-4 bg-center rounded-sm dark:bg-gray-500"
                src={femme_1}
              />
              <div className="flex flex-col">
                <h4 className="text-xl font-semibold">Leroy Jenkins</h4>
                <p className="text-sm dark:text-gray-600">Web developer</p>
                <div className="flex mt-2 space-x-2">
                  <ul className="mt-12 flex flex-wrap justify-center gap-2 ">
                    <li>
                      <Facebook />
                    </li>

                    <li>
                      <Instagram />
                    </li>

                    <li>
                      <Twitter />
                    </li>

                    <li>
                      <Github />
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="flex space-x-6">
              <img
                alt=""
                className="flex-1 flex-shrink-0 object-cover h-56 mb-4 bg-center rounded-sm dark:bg-gray-500"
                src={femme_2}
              />
              <div className="flex flex-col">
                <h4 className="text-xl font-semibold">Leroy Jenkins</h4>
                <p className="text-sm dark:text-gray-600">Web developer</p>
                <div className="flex mt-2 space-x-2">
                  <ul className="mt-12 flex flex-wrap justify-center gap-2 ">
                    <li>
                      <Facebook />
                    </li>

                    <li>
                      <Instagram />
                    </li>

                    <li>
                      <Twitter />
                    </li>

                    <li>
                      <Github />
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="flex space-x-6">
              <img
                alt=""
                className="flex-1 flex-shrink-0 object-cover h-56 mb-4 bg-center rounded-sm dark:bg-gray-500"
                src={homme_3}
              />
              <div className="flex flex-col">
                <h4 className="text-xl font-semibold">Leroy Jenkins</h4>
                <p className="text-sm dark:text-gray-600">Web developer</p>
                <div className="flex mt-2 space-x-2">
                  <ul className="mt-12 flex flex-wrap justify-center gap-2 ">
                    <li>
                      <Facebook />
                    </li>

                    <li>
                      <Instagram />
                    </li>

                    <li>
                      <Twitter />
                    </li>

                    <li>
                      <Github />
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="flex space-x-6">
              <img
                alt=""
                className="flex-1 flex-shrink-0 object-cover h-56 mb-4 bg-center rounded-sm dark:bg-gray-500"
                src={femme_3}
              />
              <div className="flex flex-col">
                <h4 className="text-xl font-semibold">Leroy Jenkins</h4>
                <p className="text-sm dark:text-gray-600">Web developer</p>
                <div className="flex mt-2 space-x-2">
                  <ul className="mt-12 flex flex-wrap justify-center gap-2 ">
                    <li>
                      <Facebook />
                    </li>

                    <li>
                      <Instagram />
                    </li>

                    <li>
                      <Twitter />
                    </li>

                    <li>
                      <Github />
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <Footer />
    </>
    );
};

export default LandingPage;