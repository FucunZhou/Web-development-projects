import React, { useState } from "react";
import "bootstrap/dist/css/bootstrap.min.css";

const ChatWindow: React.FC<ChatWindowProps> = ({ messages, onSendMessage }) => {
  const [input, setInput] = useState("");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (input.trim()) {
      onSendMessage(input);
      setInput("");
    }
  };

  return (
    <div className="d-flex flex-column vh-100">
      <div className="flex-grow-1 overflow-auto p-3">
        {messages.map((message, index) => (
          <div
            key={index}
            className={`mb-3 ${message.sender === "user" ? "text-end" : ""}`}
          >
            <div
              className={`d-inline-block p-2 rounded-3 ${
                message.sender === "user" ? "bg-primary text-white" : "bg-light"
              }`}
            >
              {message.content}
            </div>
          </div>
        ))}
      </div>
      <div className="p-3 border-top">
        <form onSubmit={handleSubmit} className="d-flex">
          <input
            type="text"
            value={input}
            onChange={(e) => setInput(e.target.value)}
            className="form-control me-2"
            placeholder="Type your message..."
          />
          <button type="submit" className="btn btn-primary">
            Send
          </button>
        </form>
      </div>
      <footer className="p-3 bg-light text-center text-muted">
        <div className="container">
          <small>© 2023 My Chat App. All rights reserved.</small>
        </div>
      </footer>
    </div>
  );
};

export default ChatWindow;
