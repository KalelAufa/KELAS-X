import React, { useEffect, useState } from "react";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import { getCustomerProfile, getStaffProfile } from "../services/authService";

const ProfilePage = () => {
  const [profile, setProfile] = useState(null);
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchProfile = async () => {
      setLoading(true);
      setError("");
      try {
        // Cek role user dari localStorage atau backend jika ada
        // Untuk contoh, kita coba getCustomerProfile dulu, jika gagal coba getStaffProfile
        try {
          const data = await getCustomerProfile();
          setProfile({ ...data, role: "customer" });
        } catch (err) {
          // eslint-disable-next-line no-unused-vars
          const staffData = await getStaffProfile();
          setProfile({ ...staffData, role: "staff" });
        }
      } catch (err) {
        setError(err.message || "Gagal mengambil data profil.");
      } finally {
        setLoading(false);
      }
    };
    fetchProfile();
  }, []);

  return (
    <div className="d-flex flex-column min-vh-100 bg-dark text-white">
      <Navbar />
      <div className="container flex-grow-1 py-5">
        <div className="row justify-content-center">
          <div className="col-md-6">
            <div className="card bg-secondary text-white border-dark shadow-lg p-4">
              <h2 className="card-title text-warning mb-4">Profil Pengguna</h2>
              {loading ? (
                <div>Loading...</div>
              ) : error ? (
                <div className="alert alert-danger">{error}</div>
              ) : profile ? (
                <div>
                  <p>
                    <strong>Nama:</strong> {profile.name}
                  </p>
                  <p>
                    <strong>Email:</strong> {profile.email}
                  </p>
                  <p>
                    <strong>Role:</strong> {profile.role}
                  </p>
                </div>
              ) : (
                <div className="alert alert-warning">
                  Tidak ada data profil.
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
      <Footer />
    </div>
  );
};

export default ProfilePage;
