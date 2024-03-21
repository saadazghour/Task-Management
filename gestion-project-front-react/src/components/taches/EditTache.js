import React, { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import axios from "axios";
import Form from "react-bootstrap/Form";
import Button from "react-bootstrap/Button";
import Swal from "sweetalert2";

export default function EditTache() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [title, setTitle] = useState("");
  const [description, setDescription] = useState("");
  const [validationError, setValidationError] = useState({});

  useEffect(() => {
    const fetchTache = async () => {
      await axios
        .get(`http://localhost:8000/api/taches/${id}`)
        .then(({ data }) => {
          setTitle(data.title);
          setDescription(data.description);
        })
        .catch((error) =>
          console.error("There was an error fetching the tache data: ", error)
        );
    };
    fetchTache();
  }, [id]);

  const updateTache = async (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append("title", title);
    formData.append("description", description);
    formData.append("_method", "PATCH"); // Laravel workaround for PUT/PATCH requests

    await axios
      .post(`http://localhost:8000/api/taches/${id}`, formData)
      .then(({ data }) => {
        Swal.fire({
          icon: "success",
          text: data.message,
        });
        navigate("/");
      })
      .catch(({ response }) => {
        if (response.status === 422) {
          setValidationError(response.data.errors);
        } else {
          Swal.fire({
            text: response.data.message,
            icon: "error",
          });
        }
      });
  };

  return (
    <div className="container">
      {/* Form similar to CreateTache */}
      <div className="row justify-content-center">
        {/* Form content here, similar to CreateTache but with updateTache function */}
        <h4 className="card-title">Edit Tache</h4>
        {/* Include form fields and a submit button */}
      </div>
    </div>
  );
}
