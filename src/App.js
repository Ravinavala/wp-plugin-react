import React from 'react';
import FaqList from './components/FaqList';
import FaqForm from './components/FaqForm';
const App = () => {
    return (
        <div>
            <h2 className='app-title'>Faq Place App</h2>
            <hr />
            <FaqList />
            <FaqForm />
        </div>
     );
}

export default App;