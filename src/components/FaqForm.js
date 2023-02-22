import React, { useState } from "react";

import "./FaqForm.css";

function FaqForm(props) {
  const [question, setQuestion] = useState("");
  const [answer, setAnswer] = useState("");
  const questionHandelr = (e) => {
      setQuestion(e.target.value);
  }
  const answerHandler = (e) => {
        setAnswer(e.target.value);
  }

  const handleSubmit = (event) => {
    event.preventDefault();
      console.log(question, answer);
  };

  return (
    <form onSubmit={handleSubmit} className="faq-form">
      <div className="form-group">
        <label htmlFor="question">Question</label>
        <input
          type="text"
          id="question"
          value={question}
          onChange={questionHandelr}
          className="form-control"
        />
      </div>
      <div className="form-group">
        <label htmlFor="answer">Answer</label>
        <textarea
          id="answer"
          value={answer}
          onChange={answerHandler}
          className="form-control"
        ></textarea>
      </div>
      <button type="submit" className="btn btn-primary">
        Add FAQ
      </button>
    </form>
  );
}

export default FaqForm;
