import React from "react";
import { useNavigate } from "react-router-dom";
import Button from "react-bootstrap/Button";
import axios from "axios";
import Swal from "sweetalert2";

const Tache = ({ tache, refreshTaches }) => {
  const navigate = useNavigate();

  const deleteTache = async (id) => {
    await axios
      .delete(`http://localhost:8000/api/taches/${id}`)
      .then(({ data }) => {
        Swal.fire({
          icon: "success",
          title: "Deleted!",
          text: data.message,
        });
        refreshTaches(); // A function passed from parent component to refresh the list after deletion
      })
      .catch((error) => {
        Swal.fire("Failed!", "There was an error deleting the tache.", "error");
        console.error("There was an error deleting the tache:", error);
      });
  };

  return (
    <div className="tache">
      {/* <h5>{tache.title}</h5>
      <p>{tache.description}</p> */}

      <h5>Tache title</h5>
      <p>Tache description</p>

      <Button
        variant="primary"
        onClick={() => navigate(`/edit-tache/${tache.id}`)}
      >
        Edit
      </Button>

      <Button variant="danger" onClick={() => deleteTache(tache.id)}>
        Delete
      </Button>
    </div>
  );
};

export default Tache;
