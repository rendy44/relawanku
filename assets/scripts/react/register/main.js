import PropTypes from 'prop-types';
import {Button, DateP, Input, Loading, Select, SelectMultiple} from "./forms"
import {ExportToCsv} from "export-to-csv";

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
    const [currentStep, setCurrentStep] = useState(1)
    const [isLoaded, setIsLoaded] = useState(false)
    const [languagePacks, setLanguagePacks] = useState({})
    const [skills, setSkills] = useState([])
    let usedForm;
    const isEmpty = object => {
        for (const property in object) {
            return false;
        }
        return true;
    }
    switch (currentStep) {
        case 1:
            usedForm = <>
                <div className={'frow gutters mb-25 row-form'}>
                    <div className={'col-sm-1-2'}>
                        <Input name={'name'} label={languagePacks.name}/>
                    </div>
                    <div className={'col-sm-1-2'}>
                        <Select name={'gender'} options={[languagePacks.male, languagePacks.female]}
                                label={languagePacks.gender}/>
                    </div>
                    <div className={'col-sm-1-2'}>
                        <Input name={'pob'} label={languagePacks.place_ob}/>
                    </div>
                    <div className={'col-sm-1-2'}>
                        <DateP label={languagePacks.date_ob}/>
                    </div>
                    <div className={'col-sm-2-2'}>
                        <Input name={'address'} label={languagePacks.address}/>
                    </div>
                    <div className={'col-sm-1-3'}>
                        <Select name={'blood'} options={['A', 'B', 'AB', 'O']} label={languagePacks.blood}/>
                    </div>
                    <div className={'col-sm-1-3'}>
                        <Select name={'marital'}
                                options={[languagePacks.single, languagePacks.married, languagePacks.widowed]}
                                label={languagePacks.marital}/>
                    </div>
                    <div className={'col-sm-1-3'}>
                        <Select name={'citizenship'} options={[languagePacks.indonesian, languagePacks.foreigner]}
                                label={languagePacks.citizenship}/>
                    </div>
                </div>
                <div className={'frow gutters row-end row-action'}>
                    <div className={'col-sm-1-3'}>
                        <Button label={languagePacks.continue} type={'primary'} callback={e => {
                            setCurrentStep(2)
                            setIsLoaded(false)
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
                        <SelectMultiple label={'Skills'} options={skills}/>
                    </div>
                </div>
                <div className={'frow gutters row-end row-action'}>
                    <div className={'col-sm-1-3'}>
                        <Button label={'Back'} type={'secondary'} callback={e => {
                            setCurrentStep(1)
                            setIsLoaded(false)
                        }
                        }/>
                    </div>
                    <div className={'col-sm-1-3'}>
                        <Button label={'Continue'} type={'primary'} callback={e => {
                            setCurrentStep(3)
                            setIsLoaded(false)
                        }
                        }/>
                    </div>
                </div>
            </>
            break;
    }
    useEffect(() => {
        switch (currentStep) {
            case 1:
                if (isEmpty(languagePacks)) {
                    wp.ajax.send(rlw.prefix + 'languages', {})
                        .done((result) => {
                            setLanguagePacks(result)
                            setIsLoaded(true)
                        })
                } else {
                    setIsLoaded(true)
                }
                break;
            case 2:
                if (skills.length <= 0) {
                    wp.ajax.send(rlw.prefix + 'skills', {})
                        .done(result => {
                            setSkills(result)
                            setIsLoaded(true)
                        })
                } else {
                    setIsLoaded(true)
                }
                break;
        }
    }, [isLoaded, currentStep])
    const usedContent = isLoaded ? usedForm : <Loading/>
    return <>
        <Step current={currentStep}/>
        <div className={'inner-content'}>
            <Title current={currentStep}/>
            {usedContent}
        </div>
    </>
}

wp.element.render(<App/>, document.getElementById("registerPage"))