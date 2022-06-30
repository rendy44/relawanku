import PropTypes from 'prop-types';
import {Button, DateP, Input, Select, SelectMultiple} from "./forms"

const {useState, useEffect, componentDidMount} = wp.element

const Step = (props) => {
    const currentStep = props.current ?? 1
    const [stepMax, setStepMax] = useState(5)
    let stepLinks = []
    for (let i = 1; i < stepMax + 1; i++) {
        stepLinks.push(<li className={i <= currentStep ? 'passed' : ''}>
            <span>{i}</span>
        </li>)
    }
    return (<div className={'steps'}>
        <ul>{stepLinks}</ul>
    </div>)
}
Step.propTypes = {
    current: PropTypes.number.isRequired
}

const Title = props => {
    const currentStep = props.current ?? 1
    let title = 'Personal Information'
    switch (currentStep) {
        case 2:
            title = 'Skills Information'
            break;
        case 3:
            title = 'Community Information'
            break;
        case 4:
            title = 'Contact Information'
            break;
        case 5:
            title = 'Confirmation'
            break
    }
    return <div className={'registration-title'}>
        <h1>{title}</h1>
    </div>
}
Title.propTypes = {
    current: PropTypes.number.isRequired
}

const App = () => {
    const [currentStep, setCurrentStep] = useState(1);
    let usedForm;
    switch (currentStep) {
        case 1:
            usedForm = <>
                <div className={'frow gutters mb-25 row-form'}>
                    <div className={'col-sm-1-2'}>
                        <Input name={'name'} label={'Full Name'}/>
                    </div>
                    <div className={'col-sm-1-2'}>
                        <Select name={'gender'} options={['Male', 'Female']} label={'Gender'}/>
                    </div>
                    <div className={'col-sm-1-2'}>
                        <Input name={'pob'} label={'Place of Birth'}/>
                    </div>
                    <div className={'col-sm-1-2'}>
                        <DateP label={'Date of Birth'}/>
                    </div>
                    <div className={'col-sm-2-2'}>
                        <Input name={'address'} label={'Address'}/>
                    </div>
                    <div className={'col-sm-1-3'}>
                        <Select name={'blood'} options={['A', 'B', 'AB', 'O']} label={'Blood Type'}/>
                    </div>
                    <div className={'col-sm-1-3'}>
                        <Select name={'marital'} options={['Single', 'Married', 'Widowed']} label={'Marital Status'}/>
                    </div>
                    <div className={'col-sm-1-3'}>
                        <Select name={'citizenship'} options={['Indonesian', 'Foreigner']} label={'Citizenship'}/>
                    </div>
                </div>
                <div className={'frow gutters row-end row-action'}>
                    <div className={'col-sm-1-3'}>
                        <Button label={'Continue'} type={'primary'} callback={e => {
                            setCurrentStep(2)
                        }
                        }/>
                    </div>
                </div>
            </>
            break;
        case 2:
            usedForm = <>
                <div className={'frow gutters mb-25 row-form'}>
                    <div className={'col-sm-1-1'}>
                        <SelectMultiple label={'Skills'}/>
                    </div>
                </div>
                <div className={'frow gutters row-end row-action'}>
                    <div className={'col-sm-1-3'}>
                        <Button label={'Back'} type={'secondary'} callback={e => {
                            setCurrentStep(1)
                        }
                        }/>
                    </div>
                    <div className={'col-sm-1-3'}>
                        <Button label={'Continue'} type={'primary'} callback={e => {
                            setCurrentStep(3)
                        }
                        }/>
                    </div>
                </div>
            </>
            break;
    }
    return <>
        <Step current={currentStep}/>
        <div className={'inner-content'}>
            <Title current={currentStep}/>
            {usedForm}
        </div>
    </>
}

wp.element.render(<App/>, document.getElementById("registerPage"))