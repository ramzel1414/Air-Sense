import React from "react";
import { Routes, Route } from "react-router-dom";

import Login from "./pages/login/Login";
import Register from "./pages/register/Register";
import Dashboard from "./pages/dashboard/Dashboard";
import Management from "./pages/management/Management";
import Location from "./pages/location/Location";
import Settings from "./pages/settings/Settings";
import Contact from "./pages/contact/Contact";


import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000'
axios.defaults.withCredentials = true


const App = () => {
    return (
        <Routes>

            <Route path="/" element={<Login />} />
            <Route path="/register" element={<Register />} />
            <Route path="/dashboard" element={<Dashboard />} />
            <Route path="/management" element={<Management />} />
            <Route path="/location" element={<Location />} />
            <Route path="/settings" element={<Settings />} />
            <Route path="/contact" element={<Contact />} />



            {/* INVALID ACCESS */}
            {/* <Route path="/404" element={<Error404 />} />
            <Route path="/401" element={<Error401 />} />

            <Route path="*" element={<Navigate to="/404" />} /> */}
      </Routes>
    );   
}

export default App;
