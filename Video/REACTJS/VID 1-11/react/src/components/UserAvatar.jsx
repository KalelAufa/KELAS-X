import React from "react";
import PropTypes from "prop-types";
import "./UserAvatar.css";

// UserAvatar component menerima props: name, avatar
const UserAvatar = ({ name, avatar }) => {
  return (
    <div className="user-avatar">
      <img src={avatar} alt={name} className="avatar-img" />
      <p>{name}</p>
    </div>
  );
};

UserAvatar.propTypes = {
  name: PropTypes.string.isRequired,
  avatar: PropTypes.string.isRequired,
};

export default UserAvatar;
