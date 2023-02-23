import react from "react";
import FaqForm from "./FaqForm";

const FaqSection = () => {
    const onSubmitHandler = (data) => {
        console.log(data);
    }
    return <div>
        <FaqForm onSubmit={onSubmitHandler} />
    </div>
}

export default FaqSection;