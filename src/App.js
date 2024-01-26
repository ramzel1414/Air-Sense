import React from "react";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";

import Login from "./pages/login/Login";
import Register from "./pages/register/Register";
import Dashboard from "./pages/dashboard/Dashboard";


import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000'
axios.defaults.withCredentials = true


const App = () => {
    return (
        <Routes>

            <Route path="/" element={<Login />} />
            <Route path="/register" element={<Register />} />

            {/* REQUIRED AUTHENTICATION */}
            <Route path="/dashboard" element={<Dashboard />} />



            {/* INVALID ACCESS */}
            {/* <Route path="/404" element={<Error404 />} />
            <Route path="/401" element={<Error401 />} />

            <Route path="*" element={<Navigate to="/404" />} /> */}
      </Routes>
    );   
}

export default App;
