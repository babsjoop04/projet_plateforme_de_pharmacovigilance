import { LogIn, LogOut } from "lucide-react";
import Logo from "../assets/logo.jpeg"
import { useState } from "react";
import { Button } from "./ui/button";

const Header = () => {
  return (
    <>
      <nav className=" bg-gray-100 shadow shadow-gray-300 w-100 px-8 md:px-auto">
        <div className="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
          {/* <!-- Logo --> */}
          <div className=" md:order-0 flex justify-between">
            <img src={Logo} className="w-14"/>
          <h5 className="font-semibold my-4 mx-2 md:order-0 ">
          Sama pharmacovigile
          </h5>

        
          </div>
          <div className="text-gray-500 order-3 w-full md:w-auto md:order-2">
            <ul className="flex font-semibold justify-between">
              {/* <!-- Active Link = text-indigo-500
                Inactive Link = hover:text-indigo-500 --> */}
              <li className="md:px-4 md:py-2 hover:text-indigo-500">
                A propos 
              </li>
              <li className="md:px-4 md:py-2 hover:text-indigo-500">
                Blog
              </li>
              <li className="md:px-4 md:py-2 hover:text-indigo-500">
                Explorer
              </li>
              
              <li className="md:px-4 md:py-2 hover:text-indigo-500">
                Contact
              </li>
              <li className="md:px-4 md:py-2 hover:text-indigo-500">
                Equipe
              </li>
            </ul>
          </div>
          <div className="order-2 md:order-3 flex justify-between">
            <Button className="px-4 mx-1 py-2 bg-indigo-500 hover:bg-indigo-600 text-gray-50 rounded-xl flex items-center gap-2">
              <LogIn/>
              <span>Se connecter</span>
            </Button>
            <Button className="px-4 py-2 mx-1 bg-indigo-500 hover:bg-indigo-600 text-gray-50 rounded-xl flex items-center gap-2">
              <LogOut/>
              <span>Deconnexion</span>
            </Button>
          </div>
        </div>
      </nav>
    </>
  );
};

export default Header;
