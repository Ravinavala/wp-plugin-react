import React, { useState } from "react";

import "./FaqForm.css";

function FaqForm(props) {
    const [question, setQuestion] = useState("");
    const [answer, setAnswer] = useState("");

    const [validateQuestion, setQuestionError] = useState(false);
    const [validateAnswer, setAnswerError] = useState(false)
    const questionHandelr = (e) => {
        setQuestion(e.target.value);
        if (question.trim().length <= 5) {
            setQuestionError(true);
        } else {
            setQuestionError(false);
        }
    }
    const answerHandler = (e) => {
        setAnswer(e.target.value);
        if (answer.trim().length <= 5) {
            setAnswerError(true);
        } else {
            setAnswerError(false);
        }
    }

    const handleSubmit = (event) => {
        event.preventDefault();
        if (question === "" || answer === "") {
            setQuestionError(true);
            setAnswerError(true);
        }
        props.onSubmit({question, answer});
    };

    return (
            <form onSubmit={handleSubmit} className="faq-form">
                <p className="shortcode">Use this shortcode  <strong>[faq_section]</strong>  on any post/page to display FAQ section : <strong>[faq_section]</strong> </p>
                <h3>Add New Faq</h3>
                <div className="form-group">
                    <label htmlFor="question">Question</label>
                    <input
                        type="text"
                        id="question"
                        //value={question}
                        onChange={questionHandelr}
                        className="form-control"
                        />
                    {validateQuestion && <span className="error">Enter valid question</span> }
                </div>
                <div className="form-group">
                    <label htmlFor="answer">Answer</label>
                    <textarea
                        id="answer"
                        //value={answer}
                        onChange={answerHandler}
                        className="form-control"></textarea>
                    {validateAnswer && <span className="error">Enter Valid Answer</span> }
                </div>
                <button type="submit" className="btn btn-primary">
                    Add FAQ
                </button>
            </form>
            );
}

export default FaqForm;
